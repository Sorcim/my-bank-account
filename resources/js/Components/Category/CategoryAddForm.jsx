import React from "react";
import {useForm} from "@inertiajs/react";
import {useModal} from "../../Contexts/ModalContext.jsx";
import {useNotification} from "../../Contexts/NotificationContext.jsx";
import {useRoute} from "ziggy-js";

const CategoryAddForm = () => {
    const route = useRoute();
    const {closeModal} = useModal();
    const {displayNotification} = useNotification();
    const { data, setData, post} = useForm({
        name: '',
        color: '#25fc24',
    })

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('category.create'), {
            onSuccess: () => {
                closeModal()
                displayNotification('category added successfully', 'success', 'category')
            },
            onError: () => {
                displayNotification('An error occured while adding the category', 'error', 'category')
            }
        });
    };

    return (
            <div className="w-full max-w-md p-6">
                <form onSubmit={handleSubmit} className="space-y-4">
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
                            placeholder="Entrez le nom de la catégorie"
                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            required
                        />
                    </div>
                    <div>
                        <label
                            htmlFor="color"
                            className="block text-sm font-medium text-gray-700"
                        >
                            Couleur
                        </label>
                        <input
                            type="color"
                            id="color"
                            name="color"
                            value={data.color}
                            onChange={e => setData('color', e.target.value)}
                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            required
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

export default CategoryAddForm;
