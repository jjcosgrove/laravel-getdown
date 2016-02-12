$(document).ready(function() {
    EnableBootstrapSelectPicker();
    EnableAutoCloseAlerts();
    EnableEpicEditors();
    EnableEpicEditorExport();
});

/**
 * a simple function to enable bootstrap-select items on the page
 */
function EnableBootstrapSelectPicker() {

    //normal behaviour
    $('.selectpicker').selectpicker({
        style: 'btn-primary',
        size: 10,
        dropupAuto: false
    });
    //templates page (for creating new from template)
    $('.selectpicker-templates').selectpicker({
        style: 'btn-default',
        size: 10,
        dropupAuto: false
    });

    //update the route when a user chooses from the template dropdown
    $('.selectpicker-templates').on('changed.bs.select', function() {
        $('.new-document').attr('href', $('.new-document').attr('original-href') + '/' + $('.selectpicker-templates').val());
        $('.new-document')[0].click();
    });
}

/**
 * shows alerts from the app and closes them after a timeout
 */
function EnableAutoCloseAlerts() {

    //shown when messages are presented to the user after an action
    $('.alert').fadeTo(2000, 500).fadeOut(500, function() {
        $('.alert').alert('close');
    });
}

/**
 * enable epiceditor - but only when there is one on the page to enable
 */
function EnableEpicEditors() {

    var readonly = {
        editable: false,
        container: 'epiceditor',
        textarea: 'epiceditor_textarea',
        basePath: '/assets/vendor/EpicEditor/epiceditor/',
        clientSideStorage: false,
        useNativeFullscreen: true,
        parser: marked,
        file: {
            name: 'epiceditor'
        },
        theme: {
            base: 'themes/base/epiceditor.css',
            preview: 'themes/preview/github.css',
            editor: 'themes/editor/epic-light.css'
        },
        button: {
            preview: false,
            fullscreen: false,
            bar: false
        },
        focusOnLoad: false,
        shortcut: {
            modifier: 18,
            fullscreen: 70,
            preview: 80
        },
        string: {
            togglePreview: 'Toggle Preview Mode',
            toggleEdit: 'Toggle Edit Mode',
            toggleFullscreen: 'Enter Fullscreen'
        },
        autogrow: {
            autogrow: true,
            minHeight: 500
        }
    };

    var editable = jQuery.extend(true, {}, readonly);
    editable.editable = true;
    editable.button.preview = true;
    editable.button.fullscreen = true;
    editable.button.bar = true;

    var mode = $('#epiceditor').hasClass('readonly') ? readonly : editable;

    $('#epiceditor').each(function() {
        EnableEpicEditor(mode);
    });
}

function EnableEpicEditor(mode) {
    var previewer;

    var editor = new EpicEditor(mode).load(function() {
        previewer = this.getElement('previewer');
        var cssTag = previewer.createElement('link');

        cssTag.rel = 'stylesheet';
        cssTag.type = 'text/css';
        cssTag.href = '/assets/vendor/highlightjs/styles/github.css';

        previewer.head.appendChild(cssTag);
    });

    editor.on('preview', function() {

        var previewerBody = previewer.body;
        var codeBlocks = previewerBody.getElementsByTagName('code');

        $(codeBlocks).each(function(i, block) {
            hljs.highlightBlock(block);
        });
    });

    if (mode.editable === false)
        editor.preview();

    EnableTabKey(editor);
    EnableCustomEpicEditorCommands(editor);
}

/**
 * event handler for the tab key. makes use of custom EE commands
 */
function EnableTabKey(editor) {
    $(editor.editor).on('keydown', function(e) {
        var keyCode = e.keyCode || e.which;

        if (keyCode == 9) {
            e.preventDefault();
            window.DefaultCommands.indent(editor, editor.editorIframeDocument.getSelection());
        }
    });
}

/**
 * enables the actual commands for EE
 */
function EnableCustomEpicEditorCommands(editor) {
    var Commands = Object.create(null);
    Commands = {
        indent: function(editor, selection) {
            //debugger;
            var list = prefixLines(getLines(selection), '\t');
            replaceWithLines(editor.editorIframeDocument, selection, list);
        }
    };
    window.DefaultCommands = Commands;
}

/**
 * add very noddy export support
 */
function EnableEpicEditorExport() {
    $('.export').on('click', function() {
        var blob = new Blob([$('textarea').val()], {
            type: "text/plain;charset=utf-8"
        });
        saveAs(blob, "GetDown.md");
    });
}

/*
 ===================================
 = HACKY CODE FOR HANDLINE CUSTOM EPIC 
 = EDITOR COMMANDS. NEEDS UPDATING
 = Taken and modified from: https://github.com/hongymagic/EpicEditor-demos
 ===================================
 */
function getLines(selection) {
    var lines = selection.toString();
    if (!lines) {
        return [];
    }
    return lines.split('\n');
}

function prefixLines(lines, prefix) {
    return lines.map(function(line) {
        return prefix + line;
    });
}

function replaceWithLines(document, selection, lines) {

    if (document === null || document === undefined) {
        document = window.document;
    }
    if (selection.rangeCount === 0) {
        return;
    }

    if (lines.length === 0) {
        document.execCommand("insertText", false, '\t');
        return;
    }

    var range = selection.getRangeAt(0);
    range.deleteContents();
    range.collapse(false);

    if (!lines) {
        return;
    }

    var fragment = document.createDocumentFragment();
    for (var i = 0; i < lines.length; i++) {
        document.execCommand("insertText", false, lines[i]);
        if (i < lines.length - 1)
            document.execCommand("insertText", false, '\n');
    }

    range.insertNode(fragment.cloneNode(true));
}