/**
 * For now, we rely on the router.js script tag to be included
 * in the layout. This is just a helper module to get that object.
 */

export default window.Routing;

/* sollte so gehen (EXPORT DUMP befehl für die json routing daten) ABER: geht nicht wie auf der Homepage beschrieben...
    ALSO NOTLÖSUNG ( und für DEV empfohlen) globale Variable Routing setzen.

const routes = require('../../../public/js/fos_js_routes.json');
import Routing from '../../../vendor/friendsofsymfony/jsrouting-bundle/Resources/js/router.js';
Routing.setRoutingData(routes);
Routing.generate('rep_log_list');*/
