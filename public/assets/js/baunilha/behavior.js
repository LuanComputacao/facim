/**
 * Created by luan on 24/07/16.
 */
show = function (eClass) {
    myelement = document.getElementsByClassName(eClass);
    console.log(myelement);
    if (myelement.style) {
        console.log('has');
    } else {
        var att = document.createAttribute('style');
        att.value = '';
        myelement[0].setAttributeNode(att);
    }

};