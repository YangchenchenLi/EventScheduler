import React from 'react';
import { BrowserRouter, Route, Switch } from 'react-router-dom';
import './App.css';
import Dashboard from './Dashboard';
import Maze from './maze/Maze';

function App() {
  return (
    <BrowserRouter>
      Header
      <div>
        <Switch>
          <Route path="/exercises/:id" component={Maze} />
          <Route path="/" component={Dashboard} />
        </Switch>
      </div>
    </BrowserRouter>
  );
}

export default App;
