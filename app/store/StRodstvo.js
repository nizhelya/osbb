/*
 * File: app/store/StRodstvo.js
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

Ext.define('Osbb.store.StRodstvo', {
    extend: 'Ext.data.Store',
    alias: 'store.stRodstvo',

    requires: [
        'Ext.data.field.String',
        'Ext.data.proxy.Memory'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StRodstvo',
            autoLoad: true,
            data: [
                {
                    rodstvo: 'головний наймач'
                },
                {
                    rodstvo: 'собственнік'
                },
                {
                    rodstvo: 'піднаймач'
                },
                {
                    rodstvo: 'батько'
                },
                {
                    rodstvo: 'матір'
                },
                {
                    rodstvo: 'сестра'
                },
                {
                    rodstvo: 'брат'
                },
                {
                    rodstvo: 'чоловік'
                },
                {
                    rodstvo: 'дружина'
                },
                {
                    rodstvo: 'дочка'
                },
                {
                    rodstvo: 'син'
                },
                {
                    rodstvo: 'онук'
                },
                {
                    rodstvo: 'онука'
                },
                {
                    rodstvo: 'батько дружини'
                },
                {
                    rodstvo: 'мати дружини'
                },
                {
                    rodstvo: 'мати чоловіка'
                },
                {
                    rodstvo: 'батько чоловіка'
                },
                {
                    rodstvo: 'син сестри'
                },
                {
                    rodstvo: 'синова дружина'
                },
                {
                    rodstvo: 'колишній чоловік'
                },
                {
                    rodstvo: 'колишня дружина'
                },
                {
                    rodstvo: 'дочка піднаймача'
                },
                {
                    rodstvo: 'син піднаймача'
                }
            ],
            fields: [
                {
                    type: 'string',
                    name: 'rodstvo'
                }
            ],
            proxy: {
                type: 'memory'
            }
        }, cfg)]);
    }
});