let callAPI = ($path='')=>{
    /* let mainURL = location.origin+'/api/'+$path;
    if(mainURL.indexOf('localhost')>=0 || mainURL.indexOf('http://127.0.0.1/')>=0){
        mainURL = 'https://ecomp.ayaantec.com/api/'+$path;
    } */
    
    let mainURL = 'https://ecomp.ayaantec.com/api/'+$path;
    return  getData(mainURL);
}

async function getData(url)
{
    let data = false;
    try{
        let res = await fetch(url);
        data = await res.json();
    }
    catch(err){
        console.log(err);
    }

    return data;
}

let getURL = (path)=>{
    let mainURL = location.origin+'/'+path;
    if(mainURL.indexOf('localhost')>=0){
        mainURL = 'https://ptc.ayaantec.com/'+path;
    }

    return  mainURL;
}

let strippedHtml = ($text, length=30) => {
    let regex = /(<([^>]+)>)/ig;
    return $text.replace(regex, "").split(' ').slice(0, length).join(' ')+'...';
}





export default {callAPI, getURL, strippedHtml}