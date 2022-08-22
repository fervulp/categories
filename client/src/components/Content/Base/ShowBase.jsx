import React from 'react';
import Record from './Record.jsx';

const Base = (props) => {
    var data = props.data
    var text = []

    function temp(ar, n) {

        for (let key in ar) {
            // text += '\t'.repeat(n) + `${ar[key]['title']} ` + `(${ar[key]['id']})`
            let marginLeft = n*70
            let data = `${ar[key]['title']} ` + `(${ar[key]['id']})`
            let id = key
            text.push([marginLeft, data, id] )

            if (ar[key]['child'] !== [] ) {
                temp(ar[key]['child'], n+1)
            } else {
                return false
            }  
        }
    }

    temp(data, 0)
    return (
        <div>
            <pre>
                {text.map((element,index) => ( <Record key={index} marginLeft={element[0]} data={element[1]} id={element[2]}/> ))}
            </pre>

        </div>
    );
}

export default Base;
