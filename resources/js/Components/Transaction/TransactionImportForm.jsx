import React from "react";
import {useForm} from "@inertiajs/react";
import {useModal} from "../../Contexts/ModalContext.jsx";
import {useNotification} from "../../Contexts/NotificationContext.jsx";

const TransactionImportForm = ({bankAccountId}) => {
    const {closeModal} = useModal();
    const {displayNotification} = useNotification();
    const { data, setData, post} = useForm({
        images: [],
        bank_account_id: bankAccountId
    })

    const handleSubmit = (e) => {
        e.preventDefault();
        post(`/transactions/receipts`, {
            onSuccess: () => {
                closeModal()
                displayNotification('Transaction import successfully', 'success', 'Transaction')
            },
            onError: () => {
                displayNotification('An error occured while adding the transaction', 'error', 'Transaction')
            }
        });
    };

    return (
            <div className="w-full max-w-md p-6">
                <form onSubmit={handleSubmit} className="space-y-4" encType="multipart/form-data">
                    <div>
                        <label
                            htmlFor="images"
                            className="block text-sm font-medium text-gray-700"
                        >
                            Images des ticket
                        </label>
                        <input
                            type="file"
                            id="images"
                            name="images"
                            onChange={e => setData('images', e.target.files)}
                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            required
                            multiple
                        />
                    </div>
                    <div>
                        <button
                            type="submit"
                            className="w-full rounded-md bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            Soumettre
                        </button>
                    </div>
                </form>
            </div>
    );
};

export default TransactionImportForm;
