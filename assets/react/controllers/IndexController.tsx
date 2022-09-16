import React from 'react';
import {
    createBrowserRouter,
    createRoutesFromElements,
    RouterProvider,
    Route,
    Link,
} from "react-router-dom";
import routes from '../routes/idea';

const router = createBrowserRouter(createRoutesFromElements(routes));

type Props = React.PropsWithChildren<{
}>;

const Component: React.FC<Props> = function (props: Props) {
    return <RouterProvider router={router} />;
}
export default Component;