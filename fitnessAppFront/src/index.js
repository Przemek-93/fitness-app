import React from 'react';
import ReactDOM from 'react-dom';
import './styles/index.css';
import App from './App';
import '@fortawesome/fontawesome-free/css/all.min.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import "react-big-calendar/lib/addons/dragAndDrop/styles.css";
import "react-big-calendar/lib/css/react-big-calendar.css";
// import { Provider } from 'react-redux';
// import store from './stores/store';

ReactDOM.render(<App />, document.getElementById('root'));

// <Provider store={store}>
//     <App />
// </Provider>, document.getElementById('root'));

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
