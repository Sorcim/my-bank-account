import React from "react";
import {useForm} from "@inertiajs/react";
import {useModal} from "../../Contexts/ModalContext.jsx";
import {useNotification} from "../../Contexts/NotificationContext.jsx";
import {useRoute} from "ziggy-js";

const RecurringTransactionAddForm = ({categories, bankAccounts}) => {
    const route = useRoute();
    const {closeModal} = useModal();
    const {displayNotification} = useNotification();
    const {data, setData, post} = useForm({
        description: '',
        amount: 0,
        category_id: '',
        frequency: 'monthly',
        start_at: new Date().toISOString().split('T')[0],
        end_at: new Date().toISOString().split('T')[0],
        bank_account_id: bankAccounts[0].id,
    })
    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('recurring.create'), {
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
                        htmlFor="bank_account_id"
                        className="block text-sm font-medium text-gray-700"
                    >
                        Compte bancaire
                    </label>
                    <select name="bank_account_id" id="bank_account_id"
                            onChange={event => setData('bank_account_id', event.target.value)}>
                        {bankAccounts.map(bankAccount => {
                                return (
                                    <option key={bankAccount.id} value={bankAccount.id}>{bankAccount.name}</option>
                                )
                            }
                        )}
                    </select>
                </div>
                <div>
                    <label
                        htmlFor="description"
                        className="block text-sm font-medium text-gray-700"
                    >
                        Description
                    </label>
                    <input
                        type="text"
                        id="description"
                        name="description"
                        value={data.description}
                        onChange={e => setData('description', e.target.value)}
                        placeholder="Entrez votre description"
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
                        Date de début
                    </label>
                    <input
                        type="date"
                        id="start_at"
                        name="start_at"
                        value={data.start_at}
                        onChange={e => setData('start_at', e.target.value)}
                        required
                    />
                </div>
                <div>
                    <label
                        htmlFor="end_at"
                        className="block text-sm font-medium text-gray-700"
                    >
                        Date de fin
                    </label>
                    <input
                        type="date"
                        id="end_at"
                        name="end_at"
                        value={data.end_at}
                        onChange={e => setData('end_at', e.target.value)}
                    />
                </div>
                <div>
                    <label
                        htmlFor="frequency"
                        className="block text-sm font-medium text-gray-700"
                    >
                        fréquence
                    </label>
                    <select name="frequency" id="frequency"
                            onChange={event => setData('frequency', event.target.value)}>
                        <option value="daily">tous les jours</option>
                        <option value="weekly">toutes les semaines</option>
                        <option selected={true} value="monthly">tous les mois</option>
                        <option value="yearly">tous les ans</option>
                    </select>
                </div>
                <div>
                    <label
                        htmlFor="category"
                        className="block text-sm font-medium text-gray-700"
                    >
                        Catégorie
                    </label>
                    <select name="category" id="category"
                            onChange={event => setData('category_id', event.target.value)}>
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

export default RecurringTransactionAddForm;
