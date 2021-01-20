/*
 * File: app/store/StTekNachFilial.js
 *
 * This file was generated by Sencha Architect version 3.2.0.
 * http://www.sencha.com/products/architect/
 *
 * This file requires use of the Ext JS 5.1.x library, under independent license.
 * License of Sencha Architect does not include license for Ext JS 5.1.x. For more
 * details see http://www.sencha.com/license or contact license@sencha.com.
 *
 * This file will be auto-generated each and everytime you save your project.
 *
 * Do NOT hand edit this file.
 */

Ext.define('Osbb.store.StTekNachFilial', {
    extend: 'Ext.data.Store',
    alias: 'store.stTekNachFilial',

    requires: [
        'Osbb.model.MdTekNach',
        'Ext.data.proxy.Direct',
        'Osbb.DirectAPI',
        'Ext.data.reader.Json'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'stTekNachFilial',
            model: 'Osbb.model.MdTekNach',
            proxy: {
                type: 'direct',
                directFn: 'QueryOrg.getResults',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        }, cfg)]);
    }
});