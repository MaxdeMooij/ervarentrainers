// webpack.config.js
var Encore = require('@symfony/webpack-encore');

Encore
// directory where all compiled assets will be stored
    .setOutputPath('web/build/')

    // what's the public path to this directory (relative to your project's document root dir)
    .setPublicPath('/build')

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    // will output as web/build/app.js
    .addEntry('search', './assets/js/search.js')
    .addEntry('main', './assets/js/main.js')

    // allow sass/scss files to be processed
    .enableSassLoader()

    .enableVueLoader()

    // allow legacy applications to use $/jQuery as a global variable
    .autoProvidejQuery()
    .autoProvideVariables({
        Popper: ['popper.js', 'default']
    })

    .enableSourceMaps(!Encore.isProduction())

// create hashed filenames (e.g. app.abc123.css)
// .enableVersioning()
;

// export the final configuration
module.exports = Encore.getWebpackConfig();