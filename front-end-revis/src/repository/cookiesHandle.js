
function setCookies(value){
    //set cookies with value
    document.cookie = value;
}

function getCookies(){
    let decodedCookies = decodeURIComponent(document.cookie);

    return decodedCookies;
}

function clearCookies(){
    //clear cookies
    document.cookie = "";
}

//export all function
export {setCookies, getCookies, clearCookies};

