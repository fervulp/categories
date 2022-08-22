import React from 'react';

const Form = (props) => {
    let hide = {
                '':[1,1,1],
                'add': [1,0,0],
                'change': [0,0,0],
                'delete': [0,1,1]
            }[props.method]   

    return(

        <div className='form'>
                <input hidden={hide[0]} type="text" className='num' placeholder='ID' name='id' />
                <input hidden={hide[1]} type="text" className='num' placeholder='Parent ID' name='parentId' /> 
                <input hidden={hide[2]} type="text" className='text' placeholder='Title' name='title' />
        </div>      
    );

}

export default Form;
