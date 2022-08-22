
const sendRequest = (method,{id, parentId, title}) => {
    const config = require('./../config/default.json')
    const url = `${config.server}:${config.port}/tree.php`
    let option = {
        'add':{
            method: 'PUT', 
            body: JSON.stringify({
                parentId: parentId.value,
                title: title.value
            })
        }, 
        'change':{
            method: 'POST', 
            body: JSON.stringify({
                id : id.value,
                parentId: parentId.value,
                title: title.value
            })
        }, 

        'delete':{
            method: 'DELETE', 
            body: JSON.stringify({
                id : id.value,
            })
        }
    }[method];
    fetch(url, option)
        .then( (res, err) => { 
            if (res.status == 200) {
                alert('Успешно выполнено')
                return 1
            } else if (res.status == 404) {
                document.querySelector('#root').innerHTML = `<h1> ${res.status} - Not found</h1>`
                return false
            }
         })
}

export default sendRequest;