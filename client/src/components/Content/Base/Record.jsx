import React from 'react';
import './Record.css';
const Record = ({ marginLeft, data, id}) => {
    
    return (
            <div id={id} className='record' style={{marginLeft: marginLeft + 'px'}}>
                <span>{data}</span>
            </div>
    );
}

export default Record;
