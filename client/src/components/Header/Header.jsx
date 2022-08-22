import React, {useState} from 'react';
import './Header.css';
import add from './../../images/add.png'
import change from './../../images/change.png'
import remove from './../../images/delete.png'
import cancel from './../../images/cancel.png'
import send from './../../images/send.png'
import startWith from './../../images/startWith.png';
import Form from './Form/Form.jsx';
import sendRequest from '../../functions/sendRequest';


const Header = ({setUpdate}) => {

    const [method, setMethod] = useState('');

    return (
        <div className='head'>
            
            <div className="tools">
                <img className='tool' onClick={ () => { 

                    localStorage.setItem('id', prompt('Ввведите id ветки, которую вы хотите просмотреть') ) 
                    setUpdate(1)
                    
                    } } src={startWith} alt="startWith"/>
                <img className='tool' onClick={ () => { setMethod('add') } } src={add} alt="add" />
                <img className='tool' onClick={ () => { setMethod('delete') } } src={remove} alt="delete"/>
                <img className='tool' onClick={ () => { setMethod('change') } } src={change} alt="change"/>
                <img hidden={ method == '' } className='tool' id='cancel' onClick={ () => { setMethod('') } } src={cancel} alt="cancel"/>
                
                <img hidden={ method == '' }  onClick={ () => {
                    if (method != '') {
                        sendRequest(method, document.getElementsByTagName("input") ) 
                        setUpdate(1)
                    }
                } } id ='send' className='tool' src={send}  alt="send" />

            </div>

            
            <Form method={method} />

        </div>
    );
}

export default Header;
