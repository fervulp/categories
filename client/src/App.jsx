import React, {useState} from 'react';
import Header from './components/Header/Header.jsx'
import Content from './components/Content/Content.jsx'
import './App.css'

const App = () => {
    const [update, setUpdate] = useState(0); // help show current database from other file if setUpdate(1) we will get current database


    return (
        <div className='app'>

            <Header setUpdate={setUpdate}/>

            <Content update={update} setUpdate={setUpdate}/>
            
        </div>
    );
}

export default App;
