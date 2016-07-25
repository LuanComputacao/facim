/**
 * Created by luan on 24/07/16.
 */
/**
 * Get content from route
 * @param method        string
 * @param route         string
 * @param callbackFunc  function
 * @param paramameters
 * @returns {*}
 */
function ajax(method, route, callbackFunc, paramameters) {
    var parameters = paramameters || null;
    var response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            response = xhttp.responseText;
            callbackFunc(response);
        }
    };
    xhttp.open(method, route, true);

    switch (method){
        case 'POST':
        case 'post':
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    }


    if (paramameters != null && paramameters != '') {
        xhttp.send(paramameters);
    }else {
        xhttp.send();
    }
}