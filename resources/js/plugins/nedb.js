let Datastore = require('nedb'),
    db = new Object()
;

db.softDeletes = new Datastore({ filename: 'softDeletes', autoload: true });
db.views = new Datastore({ filename: 'views', autoload: true });

export default db;



