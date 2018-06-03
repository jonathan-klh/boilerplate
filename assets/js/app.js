// Global assets
require('../scss/app.scss');
let req = require.context('../images/', true);
req.keys().forEach(function(key){
    req(key);
});