<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php js::import($jsRoot . 'ace/ace.js');?>
<style>
.editor-wrapper {position: relative; z-index: 1;}
.editor-wrapper pre {z-index: 2}
.editor-wrapper .actions {position: absolute; right: 15px; top: 10px; z-index: 3;}
.editor-wrapper .actions > a {color: #808080; border: 1px solid #aaa; min-width: 14px; height: 24px; line-height: 24px; text-align: center; display: block; border-radius: 3px; float: left; margin-left: 6px; padding: 0 5px}
.editor-wrapper .actions > a:hover {color: #999}
.editor-wrapper.fullscreen {position: fixed; left: 0; top: 40px; bottom: 40px; right: 0}
.editor-wrapper.fullscreen .pre {height: 100%; width: 100%}

.modal-dialog.editor-fullscreen {position: absolute; bottom: 0; right: 0; top: 0; left: 0;  width: 100%!important; margin: 0!important; height: auto!important; border-radius: 0}
.modal-dialog.editor-fullscreen .editor-wrapper.fullscreen {bottom: 80px;}
.modal-dialog.editor-fullscreen .editor-actions {position: fixed; bottom: 15px; left: 20px;}
</style>
<script>
jQuery.fn.codeeditor = function(options)
{
    return this.each(function()
    {
        var $this = $(this);
        var setting = $.extend({mode: $this.data('mode') || 'html', theme: 'textmate'}, $this.data(), options);
        if(setting.height) $this.css('height', setting.height);
        $this.css('display', 'none');
        var id = $this.attr('id') + '-editor';
        $this.before('<div class="editor-wrapper"><div class="actions"><a href="javascript:;" class="btn-fullscreen"><i class="icon-resize-full"></i></a><a href="javascript:;" data-toggle="dropdown"><i class="icon-adjust"></i> <span class="ace-theme">textmate</span> <i class="icon-caret-down"></i></a><ul class="dropdown-menu pull-right ace-themes"><li><a href="###" data-theme="ambiance">Ambiance</a></li><li><a href="###" data-theme="textmate">Textmate</a></li></ul></div><pre id="{0}"></pre></div>'.format(id));
        var $editor = $('#' + id).addClass('ace-editor').height($this.height()),
            editor = ace.edit(id);
        var $wrapper = $editor.closest('.editor-wrapper'),
            session = editor.getSession();
        editor.setValue($this.val());
        editor.setShowPrintMargin(false);
        editor.clearSelection();
        setTheme(getTheme(setting.theme));
        session.setMode("ace/mode/" + setting.mode);
        session.setUseWorker(false);
        session.on('change', function(e)
        {
            $this.val(editor.getValue());
        });

        $this.data('editor', editor);

        $wrapper.find('.btn-fullscreen').click(function()
        {
            $wrapper.toggleClass('fullscreen');
            $wrapper.closest('.modal-dialog').toggleClass('editor-fullscreen');
            $('body').toggleClass('codeeditor-fullscreen');
            $(this).find('i').toggleClass('icon-resize-small');
            if($wrapper.hasClass('fullscreen'))
            {
                $editor.data('origin-height', $editor.height()).height($wrapper.height());
            }
            else
            {
                $editor.height($editor.data('origin-height'));
            }
            editor.resize();
        });

        $wrapper.find('.ace-themes > li > a').click(function()
        {
            setTheme($(this).data('theme'));
        });

        function setTheme(theme)
        {
            $wrapper.find('.ace-themes > li.active').removeClass('active');
            $wrapper.find('.ace-themes > li > a[data-theme="' + theme + '"]').closest('li').addClass('active');
            $wrapper.find('.ace-theme').text(theme);
            editor.setTheme("ace/theme/" + theme);
            if(window['localStorage'])
            {
                localStorage.setItem('codeeditor_theme', theme);
            }
        }

        function getTheme(theme)
        {
            if(window['localStorage'])
            {
                theme = localStorage.getItem('codeeditor_theme') || theme || 'textmate';
            }
            return theme;
        }
    });
};
$(function()
{
    $('.codeeditor').codeeditor();
});
</script>
