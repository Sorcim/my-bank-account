import React from "react";
import {useForm} from "@inertiajs/react";
import {useModal} from "../../Contexts/ModalContext.jsx";
import {useNotification} from "../../Contexts/NotificationContext.jsx";

const BankAccountAddForm = () => {
    const {closeModal} = useModal();
    const {displayNotification} = useNotification();
    const { data, setData, post} = useForm({
        name: '',
        start_balance: 0
    })

    const handleSubmit = (e) => {
        e.preventDefault();
        post("/bank-accounts", {
            onSuccess: () => {
                closeModal()
                displayNotification('Bank account added successfully', 'success', 'Bank Account')
            },
            onError: () => {
                displayNotification('An error occured while adding the bank account', 'error', 'Bank Account')
            }
        });
    };

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
                            step={0.01}
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
};

export default BankAccountAddForm;
