/* loader.js */

window.CKEDITOR_BASEPATH = `/dist/admin/node_modules/ckeditor/`

// Load your custom config.js file for CKEditor.
require(`!file-loader?context=${__dirname}&outputPath=node_modules/ckeditor/&name=[path][name].[ext]!./config.js`)

// Load your custom contents.css file in case you use iframe editor.
require(`!file-loader?context=${__dirname}&outputPath=node_modules/ckeditor/&name=[path][name].[ext]!./contents.css`)

// Load your custom styles.js file for CKEditor.
require(`!file-loader?context=${__dirname}&outputPath=node_modules/ckeditor/&name=[path][name].[ext]!./styles.js`)

// require.context(
// 	'!file-loader?name=[path][name].[ext]!./extraPlugins/',
// 	true,
// 	/^\.\/((fontawesome)(\/(?!lang\/)[^/]+)*)?[^/]*$/
// )
// //
// //
// require.context(
// 	'!file-loader?name=[path][name].[ext]!./extraPlugins/',
// 	true,
// 	/^\.\/(fontawesome)\/(.*\/)*lang\/(en|es|cs)\.js$/
// )




// Load files from plugins, excluding lang files.
// Limit to active plugins with
// Object.keys(CKEDITOR.plugins.registered).sort().toString().replace(/,/g, '|')
require.context(
	'!file-loader?name=[path][name].[ext]!ckeditor/plugins/',
	true,
	/^\.\/((font|sharedspace|sourcedialog|a11yhelp|about|basicstyles|blockquote|button|clipboard|codeTag|codesnippet|contextmenu|copyformatting|dialog|dialogadvtab|dialogui|divarea|elementspath|enterkey|entities|fakeobjects|filebrowser|find|floatingspace|floatpanel|format|horizontalrule|htmlwriter|image|image2|indent|indentlist|justify|lineutils|link|list|listblock|magicline|maximize|menu|menubutton|notification|panel|pastefromword|pastetext|popup|prismhighlighter|removeformat|resize|richcombo|scayt|showblocks|showborders|sourcearea|specialchar|stylescombo|tab|table|tableselection|tabletools|toolbar|undo|widget|widgetselection|wsc|wysiwygarea)(\/(?!lang\/)[^/]+)*)?[^/]*$/
)

// Load lang files from plugins.
// Limit to active plugins with
// Object.keys(CKEDITOR.plugins.registered).sort().toString().replace(/,/g, '|')
require.context(
	'!file-loader?name=[path][name].[ext]!ckeditor/plugins/',
	true,
	/^\.\/(font|sharedspace|sourcedialog|a11yhelp|about|basicstyles|blockquote|button|clipboard|codeTag|codesnippet|contextmenu|copyformatting|dialog|dialogadvtab|dialogui|divarea|elementspath|enterkey|entities|fakeobjects|filebrowser|find|floatingspace|floatpanel|format|horizontalrule|htmlwriter|image|image2|indent|indentlist|justify|lineutils|link|list|listblock|magicline|maximize|menu|menubutton|notification|panel|pastefromword|pastetext|popup|prismhighlighter|removeformat|resize|richcombo|scayt|showblocks|showborders|sourcearea|specialchar|stylescombo|tab|table|tableselection|tabletools|toolbar|undo|widget|widgetselection|wsc|wysiwygarea)\/(.*\/)*lang\/(en|es|cs)\.js$/
)

// Load CKEditor lang files.
require.context(
	'!file-loader?name=[path][name].[ext]!ckeditor/lang',
	true,
	/(en|es|cs)\.js/
)

// Load skin.
require.context(
	'!file-loader?name=[path][name].[ext]!ckeditor/skins/moono-lisa',
	true,
	/.*/
)


