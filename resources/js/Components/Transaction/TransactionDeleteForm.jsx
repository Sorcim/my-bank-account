import {useForm} from "@inertiajs/react";
import {ExclamationTriangleIcon} from "@heroicons/react/24/outline/index.js";
import {DialogTitle} from "@headlessui/react";
import {useModal} from "../../Contexts/ModalContext.jsx";
import {useNotification} from "../../Contexts/NotificationContext.jsx";

const TransactionDeleteForm = ({ transaction }) => {
    const {closeModal} = useModal();
    const { delete:destroy} = useForm()
    const {displayNotification} = useNotification();

    const handleDelete = (e) => {
        destroy("/transactions/" + transaction.id, {
            onSuccess: () => {
                closeModal()
                displayNotification("Votre transaction à bien été supprimée.", "success", "transaction");
            },
            onError: () => {
                displayNotification("Une erreur est survenue lors de la suppression de votre compte bancaire.", "error", "bankAccount");
            }
        });
    };

    return (
        <>
            <div className="sm:flex sm:items-start">
                <div
                    className="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                    <ExclamationTriangleIcon aria-hidden="true" className="size-6 text-red-600"/>
                </div>
                <div className="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                    <DialogTitle as="h3" className="text-base font-semibold text-gray-900">
                        Supprimer la transaction
                    </DialogTitle>
                    <div className="mt-2">
                        <p className="text-sm text-gray-500">
                            Êtes-vous sûr de vouloir supprimer cette transaction? Cette action est irréversible.
                        </p>
                    </div>
                </div>
            </div>
            <div className="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <button
                    type="button"
                    onClick={handleDelete}
                    className="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto"
                >
                    Supprimer
                </button>
                <button
                    onClick={closeModal}
                    type="button"
                    data-autofocus
                    className="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                >
                    Annuler
                </button>
            </div>
        </>
    )
}

export default TransactionDeleteForm;


