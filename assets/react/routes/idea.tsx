import React from "react";

import { Route } from "react-router-dom";
import { List, Create, Update, Show } from "../components/idea";

const routes = [
  <Route path="/" element={<List />} key="list" />,
  <Route path="/new" element={<Create />} key="create" />,
  <Route path="/:id/edit/" element={<Update />} key="update" />,
  <Route path="/:id" element={<Show />} key="show" />,
];

export default routes;
