/*
 * File: app/view/sprav/TabSubsUtsznViewController.js
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

Ext.define('Osbb.view.sprav.TabSubsUtsznViewController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.tabsubsutszn',

    onComboboxSelect21: function(combo, record, eOpts) {
        var stUser = Ext.data.StoreManager.get("StUser");
        var values =stUser.getAt(0);
        var login = values.get('login');
        var password = values.get('password');

        var StUtszn = Ext.data.StoreManager.get("stSubsidiaUtszn");
        var btnGetSubsidiaUtszn =  Ext.getCmp('btnGetSubsidiaUtszn');
        var btnPrintSubsidiaUtszn =  Ext.getCmp('btnPrintSubsidiaUtszn');
        var btnReestrSubsidiaUtszn =  Ext.getCmp('btnReestrSubsidiaUtszn');
        var btnInsDoplataSubsidiaUtszn =  Ext.getCmp('btnInsDoplataSubsidiaUtszn');
        var btnInsPoplataSubsidiaUtszn =  Ext.getCmp('btnInsPoplataSubsidiaUtszn');
        var btnInsOplataSubsidiaUtszn =  Ext.getCmp('btnInsOplataSubsidiaUtszn');
        var btnControlSubsidiaUtszn =  Ext.getCmp('btnControlSubsidiaUtszn');

        var btSubsInsOplata =  Ext.getCmp('btSubsInsOplata');
        var btnSubsidiaOtkatOplata =  Ext.getCmp('btnSubsidiaOtkatOplata');

        var form =  Ext.getCmp('fmSubsUtszn');
        var data = form.getForm().findField('data_nach').getValue();
        var osmd_id = form.getForm().findField('osmd_id').getValue();
        var data = form.getForm().findField('data_nach').getValue();


        //LOGIN & PASSWORD



        //LOGIKA
        if (record) {
            values.set({'usluga_id':record.get('usluga_id')});
            stUser.sync();
            btnGetSubsidiaUtszn.setDisabled(false);
            btnPrintSubsidiaUtszn.setDisabled(false);
            btnReestrSubsidiaUtszn.setDisabled(false);
            btnInsOplataSubsidiaUtszn.setDisabled(false);
            btnInsPoplataSubsidiaUtszn.setDisabled(false);
            btnInsDoplataSubsidiaUtszn.setDisabled(false);
            btSubsInsOplata.setDisabled(false);
            btnSubsidiaOtkatOplata.setDisabled(false);
            btnControlSubsidiaUtszn.setDisabled(false);


            StUtszn.load({
                params: {
                    what:'getSubsidiaUtszn',
                    login:login,
                    password:password,
                    data:data,
                    osmd_id: osmd_id,
                    usluga_id: record.get('usluga_id')
                },
                scope:this
            });
        }
    }

});
