import React from "react";
import {useForm} from "@inertiajs/react";
import {useModal} from "../../Contexts/ModalContext.jsx";
import {useNotification} from "../../Contexts/NotificationContext.jsx";
import {useRoute} from "ziggy-js";

const TransactionAddForm = ({bankAccountId, categories}) => {
    const route = useRoute();
    const {closeModal} = useModal();
    const {displayNotification} = useNotification();
    const { data, setData, post} = useForm({
        bank_account_id: bankAccountId,
        description: '',
        amount: 0,
        effective_at: new Date().toISOString().split('T')[0],
        category_id: ''
    })
    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('transaction.create'), {
            onSuccess: () => {
                closeModal()
                displayNotification('Transaction added successfully', 'success', 'Transaction')
            },
            onError: () => {
                displayNotification('An error occured while adding the transaction', 'error', 'Transaction')
            }
        });
    };

    return (
            <div className="w-full max-w-md p-6">
                <form onSubmit={handleSubmit} className="space-y-4">
                    <div>
                        <label
                            htmlFor="description"
                            className="block text-sm font-medium text-gray-700"
                        >
                            Nom
                        </label>
                        <input
                            type="text"
                            id="description"
                            name="description"
                            value={data.description}
                            onChange={e => setData('description', e.target.value)}
                            placeholder="Entrez votre decsription"
                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            required
                        />
                    </div>
                    <div>
                        <label
                            htmlFor="amount"
                            className="block text-sm font-medium text-gray-700"
                        >
                            Montant
                        </label>
                        <input
                            type="number"
                            id="amount"
                            step={0.01}
                            name="amount"
                            value={data.amount}
                            onChange={e => setData('amount', e.target.value)}
                            placeholder="Entrez un montant"
                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            required
                        />
                    </div>
                    <div>
                        <label
                            htmlFor="effective_at"
                            className="block text-sm font-medium text-gray-700"
                        >
                            Date
                        </label>
                        <input
                            type="date"
                            id="effective_at"
                            name="effective_at"
                            value={data.effective_at}
                            onChange={e => setData('effective_at', e.target.value)}
                            required
                        />
                    </div>
                    <div>
                    <label
                        htmlFor="category"
                        className="block text-sm font-medium text-gray-700"
                    >
                        Catégorie
                    </label>
                        <select name="category" id="category" onChange={event => setData('category_id', event.target.value)}>
                            <option value=""></option>
                            {categories.map(category => {
                                return (
                                    <option key={category.id} value={category.id}>{category.name}</option>
                                )
                            }
                            )}
                        </select>
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

export default TransactionAddForm;
