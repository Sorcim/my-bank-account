import { createInertiaApp } from '@inertiajs/react'
import { createRoot } from 'react-dom/client'
import {ModalProvider} from "./Contexts/ModalContext.jsx";
import Modal from "./Components/Modal/Modal.jsx";
import Notification from "./Components/Notification/Notification.jsx";
import {NotificationProvider} from "./Contexts/NotificationContext.jsx";

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.jsx', { eager: true })
        return pages[`./Pages/${name}.jsx`]
    },
    setup({ el, App, props }) {
        createRoot(el).render(
            <ModalProvider>
                <NotificationProvider>
                    <Modal />
                    <App {...props} />
                </NotificationProvider>
            </ModalProvider>
        )
    },
})
