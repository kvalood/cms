<script language="javascript" type="text/javascript" src="design/libs/tinymce/tinymce.min.js"></script>
<script language="javascript">
{literal}

    tinymce.init({
        selector: 'textarea.full_text',
        language : "ru",
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste codemirror autoresize'
        ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',

        /* AutoResize textarea */
        autoresize_bottom_margin: 10,

        /* Редактор html кода */
        codemirror: {
            indentOnInit: true, // Whether or not to indent code on init.
            path: '/simpla/design/libs/codemirror/', // Path to CodeMirror distribution
            config: {// Default config
                theme:"seti",
                mode: "text/html",
                gutters: ["CodeMirror-lint-markers"],
                lint: true,
                lineNumbers: true,
                lineWrapping: true,
                indentUnit: 1,
                tabSize: 1,
                matchBrackets: true,
                styleActiveLine: false,
                extraKeys: {"Ctrl-Space": "autocomplete"},

            },
            jsFiles: [
                'lib/codemirror.js',
                'addon/hint/show-hint.js',
                'addon/hint/html-hint.js',
                'addon/hint/anyword-hint.js',
                'addon/hint/css-hint.js',
                'addon/hint/javascript-hint.js',
                'addon/hint/sql-hint.js',
                'addon/hint/xml-hint.js',
                'mode/htmlmixed/htmlmixed.js',
                'mode/xml/xml.js',
                'mode/javascript/javascript.js',
                'mode/css/css.js',
                'lib/jshint.js',
                'lib/jsonlint.js',
                'lib/csslint.js',
                'addon/edit/matchbrackets.js',
                'addon/edit/closebrackets.js',
                'addon/edit/closetag.js',
                'addon/edit/continuelist.js',
                'addon/edit/matchtags.js',
                'addon/edit/trailingspace.js',
                'addon/dialog/dialog.js',
                'addon/search/searchcursor.js',
                'addon/search/search.js',
                'addon/lint/lint.js',
                'addon/lint/html-lint.js',
                'addon/lint/javascript-lint.js',
                'addon/lint/css-lint.js',
                'addon/lint/json-lint.js',
            ],
            cssFiles: [// Default CSS files
                'lib/codemirror.css',
                'theme/seti.css',
                'addon/dialog/dialog.css',
                'addon/hint/show-hint.css',
                'addon/lint/lint.css',
            ],
        }

    });

    {/literal}
</script>