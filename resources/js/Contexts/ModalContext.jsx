import React, { createContext, useContext, useState } from 'react';

const ModalContext = createContext();

export const ModalProvider = ({ children }) => {
    const [isOpen, setIsOpen] = useState(false);
    const [modalContent, setModalContent] = useState(null);

    const openModal = (content) => {
        setModalContent(content);
        setIsOpen(true);
    };

    const closeModal = () => {
        setIsOpen(false);
        // setModalContent(null);
    };

    return (
        <ModalContext.Provider value={{ isOpen, modalContent, openModal, closeModal }}>
            {children}
        </ModalContext.Provider>
    );
};

// Hook personnalisé pour utiliser le contexte
export const useModal = () => useContext(ModalContext);
