/*
 * File: app/view/sprav/TabRfondViewController.js
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

Ext.define('Osbb.view.sprav.TabRfondViewController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.tabrfond',

    onCbTarifRfondSelect: function(combo, record, eOpts) {
        //in use

        //STORE

        var form = combo.findParentByType('form');
        var tarif = form.getForm().findField('tar');
        var grid = Ext.getCmp('grTarifHousesRfond');
        var btnInsTarif = Ext.getCmp('btnInsTarifRfond');
        var selected = record;

        if (record) {
            var gridRowSelectedRecords  = grid.getView().getSelectionModel().getSelection()[0];

            var size = Ext.Object.getSize(gridRowSelectedRecords) ;
            btnInsTarif.setDisabled(false);

            tarif.setValue(gridRowSelectedRecords.get(record.get('tarif')));

        }

    }

});
