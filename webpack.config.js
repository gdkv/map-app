// webpack.config.js
var Encore = require('@symfony/webpack-encore');

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    .enableSassLoader()

    .addEntry('js/app', [
        './assets/js/app.js'
    ])
    .addStyleEntry('css/app', [
        './assets/css/app.scss'
    ])
;

module.exports = Encore.getWebpackConfig();