import React, {useState, useEffect} from 'react';
import {createUserWithEmailAndPassword, onAuthStateChanged, signInWithEmailAndPassword, signOut} from 'firebase/auth';
import {BrowserRouter, Routes, Route, Link} from 'react-router-dom';
import Home from './components/home';
import Japan from './components/japan';

function App({auth}) {
  const [registerEmail, setRegisterEmail] = useState('');
  const [registerPassword, setRegisterPassword] = useState('');

  const [loginEmail, setLoginEmail] = useState('');
  const [loginPassword, setLoginPassword] = useState('');

  const [user, setUser] = useState({});

  useEffect(() => {
    onAuthStateChanged(auth, (currentUser) => {
      setUser(currentUser);
    });
  }, []);

  // useRoutes([{path: '/', element: <Home />}]);
  const register = async () => {
    try {
      const user = await createUserWithEmailAndPassword(auth, registerEmail, registerPassword);
      console.log(user);
    } catch (error) {
      console.log(error.message);
    }
  };

  const login = async () => {
    try {
      const user = await signInWithEmailAndPassword(auth, registerEmail, registerPassword);
      console.log(user);
    } catch (error) {
      console.log(error.message);
    }
  };
  const logout = async () => {
    try {
      await signOut(auth);
    } catch (error) {
      console.log(error.message);
    }
  };

  return (
    <section>
      <div>
        <h1>Register</h1>
        <input
          type='text'
          placeholder='email'
          onChange={(event) => {
            setRegisterEmail(event.target.value);
          }}
        />
        <input
          type='text'
          placeholder='passowrd'
          onChange={(event) => {
            setRegisterPassword(event.target.value);
          }}
        />
        <button onClick={register}>register</button>
      </div>
      <div>
        <h1>Login</h1>
        <input
          type='text'
          placeholder='email'
          onChange={(event) => {
            setLoginEmail(event.target.value);
          }}
        />
      </div>
      <div>
        <input
          type='text'
          placeholder='passowrd'
          onChange={(event) => {
            setLoginPassword(event.target.value);
          }}
        />
        <button onClick={login}>Login</button>
      </div>
      <h3>Loged in User:</h3>
      {user?.email}
      <button onClick={logout}>logout</button>
    </section>
  );
}

export default App;
