var Dotenv = require('dotenv-webpack');
var Encore = require('@symfony/webpack-encore');

Encore
// the project directory where all compiled assets will be stored
    .setOutputPath('public/build/')

    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')

    // will create web/build/app.js and web/build/app.css
    .addEntry('app', './assets/js/app.js')
    .addEntry('contact', './assets/js/contact/contact.js')

    //.createSharedEntry('vendors', [])

    // allow sass/scss files to be processed
    // .enableSassLoader(function(sassOptions) {}, {
    //     resolveUrlLoader: false
    //  })

    .enableSassLoader()
    .autoProvidejQuery()
    // .enableReactPreset()

	.enablePostCssLoader()

    .addPlugin(new Dotenv())

    .enableSourceMaps(!Encore.isProduction())

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    // show OS notifications when builds finish/fail
    .enableBuildNotifications()
;

module.exports = Encore.getWebpackConfig();