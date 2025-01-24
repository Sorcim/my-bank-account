import {useModal} from "../../Contexts/ModalContext.jsx";
import {useNotification} from "../../Contexts/NotificationContext.jsx";
import {useForm} from "@inertiajs/react";
import React from "react";

const BankAccountEditForm = ({ bankAccount }) => {
    const {closeModal} = useModal();
    const {displayNotification} = useNotification();
    const { data, setData, patch} = useForm({
        name: bankAccount.name,
        start_balance: bankAccount.start_balance
    })

    const handleSubmit = (e) => {
        e.preventDefault();
        patch("/bank-accounts/"+bankAccount.id, {
            onSuccess: () => {
                closeModal()
                displayNotification('Bank account edited successfully', 'success', 'Bank Account')
            },
            onError: (errors) => {
                displayNotification('Erreur lors de l\'édition du compte bancaires', 'error', 'Bank Account')
            }
        })
    }

    return (
        <div className="w-full max-w-md p-6">
            <form onSubmit={handleSubmit} className="space-y-4">
                {/* Name Field */}
                <div>
                    <label
                        htmlFor="name"
                        className="block text-sm font-medium text-gray-700"
                    >
                        Nom
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value={data.name}
                        onChange={e => setData('name', e.target.value)}
                        placeholder="Entrez votre nom"
                        className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        required
                    />
                </div>

                {/* start_balance Field */}
                <div>
                    <label
                        htmlFor="start_balance"
                        className="block text-sm font-medium text-gray-700"
                    >
                        Montant
                    </label>
                    <input
                        type="number"
                        id="start_balance"
                        name="start_balance"
                        value={data.start_balance}
                        onChange={e => setData('start_balance', e.target.value)}
                        placeholder="Entrez un montant"
                        className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        required
                    />
                </div>

                {/* Submit Button */}
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
}

export default BankAccountEditForm;
