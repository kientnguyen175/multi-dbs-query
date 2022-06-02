let mix = require('laravel-mix');
const fs = require("fs");

(() => {
    const dirJsResource = "./resources/assets/js";
    let dirJs = fs.readdirSync(dirJsResource, "utf-8");
    dirJs = dirJs.filter(item => /\.js$/.test(item));
    dirJs.forEach(element => {
        mix.js(`resources/assets/js/${element}`, "public/js");
    });
})();

(() => {
    const dirSassResource = "./resources/assets/sass";
    let dirSass = fs.readdirSync(dirSassResource, "utf-8");
    dirSass = dirSass.filter(item => /\.scss$/.test(item));
    dirSass.forEach(element => {
        mix.sass(`resources/assets/sass/${element}`, "public/css").vue();
    });
})();
