import React, {Component} from 'react';
import {BrowserRouter, Routes, Route, Link} from 'react-router-dom';
import Home from './components/home';
import Japan from './components/japan';
// import styles from './app.module.css';

function App() {
  // useRoutes([{path: '/', element: <Home />}]);
  return (
    <>
      <BrowserRouter>
        <Routes>
          <Route path='/home' element={<Home />} />
          <Route path='/japan' element={<Japan />} />
        </Routes>
      </BrowserRouter>
    </>
  );
}
export default App;
