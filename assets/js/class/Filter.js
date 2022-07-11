import Ajax from './Ajax.js';

export default class Filter {

    constructor(target) {
        this.AjaxClass = new Ajax();
        this.verif(target);
    }

    verif(target) {
        switch (target) {

            case 'teamList':
                this.AjaxClass.requestHtml('index.php?ajax=teamList');
                break;
            case 'geoCacheList':
                this.AjaxClass.requestHtml('index.php?ajax=geoCacheList');
                break;
            case 'addGeoCache':
                this.AjaxClass.requestHtml('index.php?ajax=addGeoCache');
                break;
            case 'addTeam':
                this.AjaxClass.requestHtml('index.php?ajax=addTeam');
                break;
            case 'removeGeocache':
                this.AjaxClass.requestHtml('index.php?ajax=removeGeocache');
                break;

        }
    }
}