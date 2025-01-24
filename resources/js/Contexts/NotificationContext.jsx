import React, { createContext, useContext, useState } from 'react';

const NotificationContext = createContext();

export const NotificationProvider = ({ children }) => {
    const [isDisplay, setIsDisplay] = useState(false);
    const [notificationType, setNotificationType] = useState('success');
    const [notificationContent, setNotificationContent] = useState(null);
    const [notificationTitle, setNotificationTitle] = useState(null);

    const displayNotification = (content, type, title) => {
        setNotificationContent(content)
        setNotificationType(type)
        setNotificationTitle(title)
        setIsDisplay(true)
        setTimeout(() => removeNotification(), 5000);
    };

    const removeNotification = () => {
        setIsDisplay(false);
    };

    return (
        <NotificationContext.Provider value={{ isDisplay, notificationContent, notificationType, displayNotification, removeNotification, notificationTitle }}>
            {children}
        </NotificationContext.Provider>
    );
};

// Hook personnalisé pour utiliser le contexte
export const useNotification = () => useContext(NotificationContext);
