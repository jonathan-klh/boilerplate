// Global assets
require('../scss/app.scss');
var $ = require('jquery');

let req = require.context('../images/', true);
req.keys().forEach(function(key){
    req(key);
});