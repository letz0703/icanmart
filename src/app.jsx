import React, {Component} from 'react';
import {BrowserRouter, Routes, Route, Link} from 'react-router-dom';
import Home from './components/home';
import Japan from './components/japan';
// import styles from './app.module.css';

function App({auth}) {
  // useRoutes([{path: '/', element: <Home />}]);
  return (
    <>
      <section>
        <h1>Register</h1>
        <input type='text' placeholder='email' />
        <input type='text' placeholder='passowrd' />
        <button>register</button>
        <h1>Login</h1>
        <input type='text' placeholder='email' />
        <input type='text' placeholder='passowrd' />
        <button>Login</button>
        <h3>Loged in User:</h3>
        {auth.user?.email}
        <button>logout</button>
      </section>
      {/* <BrowserRouter>
        <Routes>
          <Route path='/home' element={<Home />} />
          <Route path='/japan' element={<Japan />} />
        </Routes>
      </BrowserRouter> */}
    </>
  );
}
export default App;
