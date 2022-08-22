import React, {useState, useEffect}  from 'react';
import './Content.css' 
import Base from './Base/ShowBase.jsx'


const Content = ({update, setUpdate}) => {
    const config = require('./../../config/default.json')
    const [base, setBase] = useState('');


    function getBase() {
        let id = 0
        if (localStorage.getItem('id')) {
            id = localStorage.getItem('id')
        }
        fetch(`${config.server}:${config.port}/tree.php?id=${id}`, {
            method:'GET', 
            headers: {'Content-Type': 'application/json;charset=utf-8'},
        })
        .then(response => response.json())
        .then(result => setBase(result) )
    }

    useEffect(() => {
        setUpdate(0);
        getBase();
        
    }, [update]); // show current database
    
    
    return (
        
        <div className='content'>
            
            <Base data={ base }/>
            
        </div>
    );
}

export default Content;
