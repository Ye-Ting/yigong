/* theme */
+function($, window, document, Math)
{
    "use strict";

    // hex color reg
    var hexReg = /^#([0-9a-fA-f]{3}|[0-9a-fA-f]{6})$/;
    var lessFileTemplate = '/template/{0}/theme/{1}/style.less';
    var lessConfigTemplate = '/template/{0}/theme/{1}/setting.json';
    var lessTemplates = {};
    var useLessCache = false;

    var Theme = function(options, variables)
    {
        this.getOptions(options);
        // If the theme with an config file then call this: this.getConfig();
        this.getLess();
        this.variables = variables;
    };

    Theme.prototype.getOptions = function (options)
    {
        this.options = $.extend({}, Theme.DEFAULTS, options);
        if(!this.options.lessFile)
        {
            this.options.lessFile   = lessFileTemplate.format(this.options.template, this.options.theme);
            this.options.configFile = lessConfigTemplate.format(this.options.template, this.options.theme);
        }
    };

    Theme.prototype.beauty = function(css)
    {
        return css.format($.extend(
        {
            buildTime: (new Date()).toString()
        }, this, this.options));
    };

    Theme.prototype.compileVariables = function(variables)
    {
        variables = $.extend({}, this.config, this.options.variables, variables || this.variables);
        var lessCode = '';
        for(var key in variables)
        {
            var val = variables[key];
            lessCode += '@' + key + ': ' + (val.value || val) + ';' + (val.desc ? (' // ' + val.desc) : '') + '\n';
        }
        this.variablesCode = lessCode;
        return lessCode + '\n';
    };

    Theme.prototype.compile = function(variables)
    {
        this.compileVariables(variables);

        var lessCode = this.less.replace(/@import "@variables";/, this.variablesCode),
            parser   = window.less.Parser(),
            options  = this.options,
            that     = this,
            css      = '';

        parser.parse(lessCode, function(error, result)
        {
            if(!error && result)
            {
                css = that.beauty(result.toCSS());
            }
            else
            {
                throw new Error('Theme compile: ' + error);
            }
        });

        this.css = css;
        return css;
    };

    Theme.prototype.getConfig = function()
    {
        this.config = null;
        try
        {
            $.getJSON(this.options.configFile, function(json)
            {
                this.config = json;
            });
        }
        catch(e){}
    };

    Theme.prototype.getLess = function()
    {
        /* get template */
        var url = this.options.lessFile + '?v=' + (new Date()).getTime();
        this.less = useLessCache ? lessTemplates[url] : null;
        if(!this.less)
        {
            var that = this;
            $.ajax({url: url, async: false, type: 'GET', contentType: 'text/plain'})
             .done(function(data, textStatus, jqXHR) {that.less = jqXHR.responseText; lessTemplates[url] = that.less;})
             .fail(function() {throw new Error("Can't get theme template(a less file named '" + url + "')!");});
        }
    };

    Theme.DEFAULTS =
    {
        theme     : 'default',
        template  : 'default',
        variables :
        {
            "font-family"      : {value: '"Helvetica Neue", Helvetica, Tahoma, Arial, sans-serif', desc: 'Global font family'},
            "background-color" : "#FFF",
            "fore-color"       : "#333",
            "secondary-color"  : "#145CCD",
            "back-color"       : "#FFF",
            "text-color"       : "#333",
            "font-size"        : "12px",
            "font-weight"      : "normal",
            "border-width"     : '1px',
            "border-style"     : 'solid',
            "border-radius"    : '3px'
        }
    };

    window.Theme      = Theme;
}(jQuery, window, document, Math);
