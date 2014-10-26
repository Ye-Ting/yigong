<?php
/**
 * The model file of ui module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
class uiModel extends model
{
    /**
     * Get templates available.
     * 
     * @access public
     * @return void
     */
    public function getTemplates()
    {
        $this->app->loadClass('Spyc', true);
        $folders = glob($this->app->getTplRoot() . '*');
        foreach($folders as $folder)
        {
            $templateName = str_replace($this->app->getTplRoot(), '', $folder);
            $docFile      = $folder . DS . 'doc' . DS . $this->app->getClientLang() . '.yaml';
            if(!is_file($docFile)) continue;
            $config       = Spyc::YAMLLoadString(file_get_contents($docFile));
            if(empty($config)) continue;
            $templates[$templateName] = $config;
        }
        return $templates;
    }

    /**
     * Get authorities needed when install.
     * 
     * @access public
     * @return void
     */
    public function checkAuthorities()
    {
        $authorities = array();

        $authorities['package']['path']     = $this->app->getDataRoot() . 'template' . DS;
        $authorities['package']['exists']   = is_dir($authorities['package']['path']);
        $authorities['package']['writable'] = is_writable($authorities['package']['path']);

        $authorities['template']['path']     = $this->app->getTplRoot();
        $authorities['template']['exists']   = is_dir($authorities['template']['path']);
        $authorities['template']['writable'] = is_writable($authorities['template']['path']);

        $errors = '';
        $commands = '';
        foreach($authorities as $authority)
        {
            if(!$authority['exists'])  
            {
                $errors   .= sprintf($this->lang->ui->template->error->exists, $authority['path']);
                $commands .= sprintf($this->lang->ui->template->commands->exists, $authority['path']);
            }
            if(!$authority['writable']) 
            {
                $errors   .= sprintf($this->lang->ui->template->error->writable, $authority['path']);
                $commands .= sprintf($this->lang->ui->template->commands->writable, $authority['path']);
            }
        }

        return array($errors, $commands);
    }

    /**
     * Extract template package.
     * 
     * @param  string    $package 
     * @access public
     * @return void
     */
    public function extractPackage($package)
    {
        $packageFile = $this->app->getDataRoot() . "template/{$package}.zip";

        $this->app->loadClass('pclzip', true);
        $zip = new pclzip($packageFile);
        $files = $zip->listContent();

        $tempPath = $this->app->getDataRoot() . 'template/' . $package . DS;

        if(is_dir($tempPath))
        {
            $fileClass = $this->app->loadClass('zfile');
            $fileClass->removeDir($tempPath);
        }

        $return = new stdclass();
        $removePath = $files[0]['filename'];
        if($zip->extract(PCLZIP_OPT_PATH, $tempPath, PCLZIP_OPT_REMOVE_PATH, $removePath) == 0)
        {
            $return->result = 'fail';
            $return->error  = $zip->errorInfo(true);
        }
        return true;
    }

    /**
     * Get info from template package. 
     * 
     * @param  string    $package 
     * @access public
     * @return void
     */
    public function getInfoFromPackage($package)
    {
        $this->app->loadClass('Spyc', true);
        $tempPath = $this->app->getDataRoot() . 'template/' . $package . DS;
        return Spyc::YAMLLoadString(file_get_contents($tempPath . 'doc' . DS . $this->app->getClientLang() . '.yaml'));
    }

    /**
     * Copy package files. 
     * 
     * @param  string    $package 
     * @access public
     * @return array
     */
    public function copyTemplateFiles($package)
    {
        $templateRoot = $this->app->getTplRoot();
        $packagePath  = $this->app->getDataRoot() . 'template' . DS . $package . DS;

        $pathes = scandir($packagePath);

        $fileClass   = $this->app->loadClass('zfile');
        $copiedFiles = $fileClass->copyDir($packagePath, $templateRoot . $package);

        $fileClass = $this->app->loadClass('zfile');
        $fileClass->removeDir($packagePath);

        return $copiedFiles;
    }

    /**
     * Get template option menu.   
     * 
     * @access public
     * @return void
     */
    public function getTemplateOptions()
    {
        $this->app->loadClass('Spyc', true);
        $folders = glob($this->app->getTplRoot() . '*');
        foreach($folders as $folder)
        {
            $templateName = str_replace($this->app->getTplRoot(), '', $folder);
            $config = Spyc::YAMLLoadString(file_get_contents($folder . DS . 'doc' . DS . $this->app->getClientLang() . '.yaml'));
            $templates[$templateName] = $config['name'];
        }

        return $templates;
    }

    /**
     * Set UI option with file. 
     * 
     * @param  int    $type 
     * @param  int    $htmlTagName 
     * @access public
     * @return void
     */
    public function setOptionWithFile($section, $htmlTagName, $allowedFileType = 'jpg,jpeg,png,gif,bmp')
    {
        if(empty($_FILES)) return array('result' => false, 'message' => $this->lang->ui->noSelectedFile);

        $fileType = substr($_FILES['files']['name'], strrpos($_FILES['files']['name'], '.') + 1); 
        if(strpos($allowedFileType, $fileType) === false) return array('result' => false, 'message' => sprintf($this->lang->ui->notAlloweFileType, $allowedFileType));

        $fileModel = $this->loadModel('file');

        if(!$this->file->checkSavePath()) return array('result' => false, 'message' => $this->lang->file->errorUnwritable);

        /* Delete old files. */
        $oldFiles = $this->dao->select('id')->from(TABLE_FILE)->where('objectType')->eq($section)->fetchAll('id');
        foreach($oldFiles as $file) $fileModel->delete($file->id);
        if(dao::isError()) return array('result' => false, 'message' => $this->lang->fail);

        /* Upload new logo. */
        $uploadResult = $fileModel->saveUpload($htmlTagName);
        if(!$uploadResult) return array('result' => false, 'message' => $this->lang->fail);

        $fileIdList = array_keys($uploadResult);
        $file       = $fileModel->getById($fileIdList[0]); 

        /* Save new data. */
        $setting  = new stdclass();
        $setting->fileID    = $file->id;
        $setting->pathname  = $file->pathname;
        $setting->webPath   = $file->webPath;
        $setting->addedBy   = $file->addedBy;
        $setting->addedDate = $file->addedDate;

        $result = $this->loadModel('setting')->setItems('system.common.site', array($section => helper::jsonEncode($setting)));
        if($result) return array('result' => true);

        return array('result' => false, 'message' => $this->lang->fail);
    }

    /**
     * Create html of color plates list.
     *
     * @param string       $plates
     * return string 
     */
    public function createColorPlates($plates = '')
    {
        if(empty($plates))
        {
            $plates = $this->lang->ui->theme->colorPlates;
        }

        $colorPlates = '';
        foreach (explode('|', $plates) as $value)
        {
            $colorPlates .= "<div class='color color-tile' data='{$value}' data-toggle='tooltip' title='{$value}'><i class='icon-ok'></i></div>";
        }
        return $colorPlates;
    }

    /**
     * Print form control.
     * 
     * @param  string    $id 
     * @param  string    $label 
     * @param  array     $params 
     * @param  mix       $value 
     * @access public
     * @return string
     */
    public function printFormControl($label, $params, $value = false)
    {
        $methodName = 'print' . $params['type'] . 'Control';
        call_user_func_array(array($this, $methodName), array('id' => $params['name'], 'label' => $label, 'params' => $params, 'value' => $value));
    }

    /**
     * Print color control.
     * 
     * @param  string    $id 
     * @param  string    $label 
     * @param  array     $params 
     * @param  mix       $value 
     * @access public
     * @return string
     */
    public function printColorControl($id, $label, $params, $value = false)
    {
        $originDefault = $params['default'];
        $default = ($value === false or empty($value)) ? $originDefault : $value;
        $placeholder = $default;
        if($placeholder === 'transparent') $placeholder = $this->lang->ui->transparent;

        $html = "<div class='colorplate theme-control' data-id='{$id}'>\n";
        $html .= "<div class='input-group color active input-group-color' data='{$default}'>\n";
        $html .= "<span class='input-group-btn'>\n";
        $html .= "<button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>\n";
        $html .= "{$this->lang->ui->$label} <span class='caret'></span>\n</button>\n";
        $html .= "<div class='dropdown-menu colors'>" . $this->createColorPlates() . "</div>\n</span>\n";
        $html .= "<input id='{$id}' name='{$id}' type='text' value='{$value}' data-origin-default='{$originDefault}' data-default='{$default}' placeholder='{$placeholder}' class='form-control input-color text-latin' data-toggle='tooltip' title='{$this->lang->ui->theme->colorTip}'>\n";
        $html .= "</div>\n</div>\n";
        echo $html;
    }

    /**
     * Print size control
     * @param  string  $id
     * @param  string  $label
     * @param  array   $params
     * @param  mix     $value
     * @return void
     */
    public function printSizeControl($id, $label, $params, $value = false)
    {
        $this->printTextbox($id, $value, $this->lang->ui->$label, '', $params['default'], '', '', $this->lang->ui->theme->sizeTip);
    }

     /**
     * Print image control
     * @param  string  $id
     * @param  string  $label
     * @param  array   $params
     * @param  mix     $value
     * @return void
     */
    public function printImageControl($id, $label, $params, $value = '')
    {
        $placeholder = $params['default'];
        $default =  $placeholder;
        if(empty($placeholder) or $placeholder == 'none')
        {
            $placeholder = $this->lang->ui->none;
            $default     = 'none';
        }
        if($default == 'inherit')
        {
            $placeholder = $this->lang->ui->theme->default;
        }

        $this->printTextbox($id, $value, $this->lang->ui->$label, '', $placeholder, '', "data-default='{$default}' data-type='image'", $this->lang->ui->theme->backImageTip);
    }

    /**
     * Print image repeat contorl
     * @param  string  $id
     * @param  string  $label
     * @param  array   $params
     * @param  mix     $value
     * @return void
     */
    public function printRepeatControl($id, $label, $params, $value = '')
    {
        $this->printSelectList($this->lang->ui->theme->imageRepeatList, $id, $value, $this->lang->ui->$label, '', '', '', $params['default']);
    }

    public function printPositionControl($id, $label, $params, $value = '0% 0%')
    {
        $values = explode(' ', $value);
        $defaultValues = explode(' ', $params['default']);
        $defaultValue1 = count($defaultValues) > 0 ? $defaultValues[0] : '0';
        $defaultValue2 = count($defaultValues) > 1 ? $defaultValues[1] : '0';
        $value1 = count($values) > 0 ? $values[0] : $defaultValue1;
        $value2 = count($values) > 1 ? $values[1] : $defaultValue2;

        $this->printTextboxCouple($this->lang->ui->$label, $id, $id . '-x', $value1, 'X', $id . '-y', $value2, 'Y', '', $defaultValue1, $defaultValue2);
    }

    /**
     * Print border control
     * @param  string $id
     * @param  string $label
     * @param  array  $params
     * @param  string $value
     * @return void
     */
    public function printBorderControl($id, $label, $params, $value = '')
    {
        $this->printSelectList($this->lang->ui->theme->borderStyleList, $id, $value, $this->lang->ui->$label, '', '', '', $params['default']);
    }

    /**
     * Print border control
     * @param  string $id
     * @param  string $label
     * @param  array  $params
     * @param  string $value
     * @return void
     */
    public function printUnderlineControl($id, $label, $params, $value = '')
    {
        $this->printSelectList($this->lang->ui->theme->underlineList, $id, $value, $this->lang->ui->$label, '', '', '', $params['default']);
    }

    /**
     * Print nav layout
     * @param  string $id
     * @param  string $label
     * @param  array  $params
     * @param  string $value
     * @return void
     */
    public function printNavLayoutControl($id, $label, $params, $value = '')
    {
        $this->printSelectList($this->lang->ui->theme->navbarLayoutList, $id, $value, $this->lang->ui->$label, '', '', '', $params['default']);
    }

    /**
     * Print font size control
     * @param  string $id
     * @param  string $label
     * @param  array  $params
     * @param  string $value
     * @return void
     */
    public function printFontSizeControl($id, $label, $params, $value = '')
    {
        $this->printSelectList($this->lang->ui->theme->fontSizeList, $id, $value, $this->lang->ui->$label, '', '', '', $params['default']);
    }

    /**
     * Print font family control
     * @param  string $id
     * @param  string $label
     * @param  array  $params
     * @param  string $value
     * @return void
     */
    public function printFontFamilyControl($id, $label, $params, $value = '')
    {
        $this->printSelectList($this->lang->ui->theme->fontList, $id, $value, $this->lang->ui->$label, '', '', '', $params['default']);
    }

    /**
     * Print font weight control
     * @param  string $id
     * @param  string $label
     * @param  array  $params
     * @param  string $value
     * @return void
     */
    public function printFontWeightControl($id, $label, $params, $value = '')
    {
        $this->printSelectList($this->lang->ui->theme->fontWeightList, $id, $value, $this->lang->ui->$label, '', '', '', $params['default']);
    }

    /**
     * Print sidebar layout
     * @param  string $id
     * @param  string $label
     * @param  array  $params
     * @param  string $value
     * @return void
     */
    public function printSidebarLayoutControl($id, $label, $params, $value = '')
    {
        $this->printSelectList($this->lang->ui->theme->sidebarPullLeftList, $id, $value, $this->lang->ui->$label, '', '', '', $params['default']);
    }

    /**
     * Print sidebar width
     * @param  string $id
     * @param  string $label
     * @param  array  $params
     * @param  string $value
     * @return void
     */
    public function printSidebarWidthControl($id, $label, $params, $value = '')
    {
        $this->printSelectList($this->lang->ui->theme->sidebarWidthList, $id, $value, $this->lang->ui->$label, '', '', '', $params['default']);
    }

    /**
     * Print html of textbox with label.
     *
     * @param string       $name
     * @param string       $value
     * @param string       $startLabel
     * @param string       $endLabel
     * @param mix          $placeholder
     * @param string       $class
     * @param string       $alias
     * @param string       $tooltip
     * return string 
     */
    public function printTextbox($name, $value, $startLabel = '', $endLabel = '', $placeholder = false, $class = '', $alias = '', $tooltip = '')
    {
        if($placeholder === false)
        {
            $placeholder = $value;
        }

        $html = "<div class='input-group input-group-textbox theme-control' data-id='{$name}'>\n";
        if(!empty($startLabel))
        {
            $html .= "<span class='input-group-addon'>{$startLabel}</span>\n";
        }

        $html .= "<input id='{$name}' name='{$name}' type='text' value='{$value}' placeholder='{$placeholder}' class='form-control input-color text-latin {$class}' {$alias}" . (empty($tooltip) ? "" : " title='{$tooltip}' data-toggle='tooltip'") . ">\n";

        if(!empty($endLabel))
        {
            $html .= "<span class='input-group-addon'>{$endLabel}</span>\n";
        }
        $html .= "</div>\n";
        echo $html;
    }

    /**
     * Print html of select with input group
     *
     * @param string       $list
     * @param string       $name
     * @param string       $startLabel
     * @param string       $value
     * @param string       $label
     * @param string       $class
     * @param string       $alias
     * @param string       $tooltip
     * return string 
     */
    public function printSelectList($list, $name, $value = '', $label = '', $class = '', $alias = '', $tooltip = '', $default = '')
    {
        $html = "<div class='input-group input-group-select theme-control' data-id='{$name}'>\n";
        if(!empty($label))
        {
            $html .= "<span class='input-group-addon'>{$label}</span>\n";
        }

        if(empty($value))
        {
            $value = $default;
        }

        $html .= html::select($name, $list, $value, "data-default='{$default}' class='form-control {$class}' {$alias}" . (empty($tooltip) ? "" : " title='{$tooltip}' data-toggle='tooltip'")) . "\n";

        $html .= "</div>\n";
        echo $html;
    }

    /**
     * Print html of inputgroup with two textbox cell
     *
     * @param string       $labelStart
     * @param string       $name
     * @param string       $name1
     * @param string       $value1
     * @param string       $label1
     * @param string       $name2
     * @param string       $value2
     * @param string       $label2
     * @param string       $labelEnd
     * @param mix          $placeholder1
     * @param mix          $placeholder2
     * @param string       $tooltip1
     * @param string       $tooltip2
     * @param string       $alias1
     * @param string       $alias2
     * return string 
     */
    public function printTextboxCouple($labelStart, $name, $name1, $value1, $label1, $name2, $value2, $label2, $labelEnd, $placeholder1 = false, $placeholder2 = false, $tooltip1 = '', $tooltip2 = '', $alias1 = '', $alias2 = '')
    {
        if($placeholder1 === false)
        {
            $placeholder1 = $value1;
        }
        if($placeholder2 === false)
        {
            $placeholder2 = $value2;
        }

        $html = "<div class='input-group input-group-textbox-couple theme-control' data-id='{$name}'>\n";
        if(!empty($labelStart))
        {
            $html .= "<span class='input-group-addon'>{$labelStart}</span>\n";
        }

        if(!empty($label1))
        {
            $html .= "<span class='input-group-addon" . (empty($labelStart) ? '' : " fix-border") . "'>{$label1}</span>\n";
        }

        $html .= "<input id='{$name1}' data-sid='{$name}-1' data-target='{$name}' name='{$name1}' type='text' value='{$value1}' placeholder='{$placeholder1}' class='form-control input-color text-latin' {$alias1}" . (empty($tooltip1) ? "" : " title='{$tooltip1}' data-toggle='tooltip'") . ">";

        if(!empty($label2))
        {
            $html .= "<span class='input-group-addon fix-border'>{$label2}</span>\n";
        }
        else
        {
            $html .= "<span class='input-group-addon fix-border fix-padding'></span>\n";
        }

        $html .= "<input id='{$name2}' data-sid='{$name}-2' data-target='{$name}' name='{$name2}' type='text' value='{$value2}' placeholder='{$placeholder2}' class='form-control input-color text-latin' {$alias2}" . (empty($tooltip2) ? "" : " title='{$tooltip2}' data-toggle='tooltip'") . ">\n";

        if(!empty($endLabel))
        {
            $html .= "<span class='input-group-addon'>{$endLabel}</span>\n";
        }

        $html .= "<input type='hidden' id='{$name}' name='$name' value='{$value1} {$value2}'>";
        $html .= "</div>\n";
        echo $html;
    }
}
