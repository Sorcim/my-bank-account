import BaseLayout from "../../Layout/BaseLayout.jsx";
import {Fragment} from "react";
import {useModal} from "../../Contexts/ModalContext.jsx";
import CategoryAddButton from "../../Components/Category/CategoryAddButton.jsx";
import {Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/react";
import {EllipsisHorizontalIcon} from "@heroicons/react/20/solid";
import CategoryDeleteForm from "../../Components/Category/CategoryDeleteForm.jsx";
import CategoryEditForm from "../../Components/Category/CategoryEditForm.jsx";
import categoryAddForm from "../../Components/Category/CategoryAddForm.jsx";

const ListCategories = ({categories}) => {
    const {openModal} = useModal()
    return (
        <>
            <div className="flex items-center justify-between">
                <h2 className="text-base/7 font-semibold text-gray-900">List des catégories</h2>
                <CategoryAddButton />
            </div>
            <div className="mt-6 overflow-hidden border-t border-gray-100">
                <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div className="mx-auto max-w-2xl lg:mx-0 lg:max-w-none">
                        <table className="w-full text-left">
                            <thead className="sr-only">
                            <tr>
                                <th>Amount</th>
                                <th className="hidden sm:table-cell">Client</th>
                                <th>More details</th>
                            </tr>
                            </thead>
                            <tbody>
                                    {categories.map((category) =>
                                        (<tr key={category.id}>
                                            <td className="relative py-5 pr-6">
                                                <div className="flex gap-x-6">
                                                    <div className="flex-auto">
                                                        <div className="flex items-start gap-x-3">
                                                            <div
                                                                className={`rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset `}
                                                                style={{backgroundColor: category.color}}
                                                            >
                                                                {category.name}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    className="absolute bottom-0 right-full h-px w-screen bg-gray-100"/>
                                                <div className="absolute bottom-0 left-0 h-px w-screen bg-gray-100"/>
                                            </td>
                                            <td className="hidden py-5 pr-6 sm:table-cell">
                                                <div className="text-sm/6 text-gray-900">{category.name}</div>
                                                <div
                                                    className="mt-1 text-xs/5 text-gray-500">{category.color}</div>
                                            </td>
                                            <td className="py-5 text-right">
                                                <div className="flex justify-end">
                                                    <Menu as="div" className="relative ml-auto">
                                                        <MenuButton className="-m-2.5 block p-2.5 text-gray-400 hover:text-gray-500">
                                                            <span className="sr-only">Open options</span>
                                                            <EllipsisHorizontalIcon aria-hidden="true" className="size-5"/>
                                                        </MenuButton>
                                                        <MenuItems
                                                            transition
                                                            className="absolute right-0 z-10 mt-0.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 transition focus:outline-none data-[closed]:scale-95 data-[closed]:transform data-[closed]:opacity-0 data-[enter]:duration-100 data-[leave]:duration-75 data-[enter]:ease-out data-[leave]:ease-in"
                                                        >
                                                            <MenuItem>
                                                                <button
                                                                    onClick={() => openModal(<CategoryEditForm category={category}/>)}
                                                                    className="block w-full px-3 py-1 text-sm/6 text-gray-900 data-[focus]:bg-gray-50 data-[focus]:outline-none"
                                                                >
                                                                    Edit
                                                                </button>
                                                            </MenuItem>
                                                            <MenuItem>
                                                                <button
                                                                    className="block w-full px-3 py-1 text-sm/6 text-red-500 data-[focus]:bg-gray-50 data-[focus]:outline-none"
                                                                    onClick={() => openModal(<CategoryDeleteForm category={category}/>)}
                                                                >
                                                                    Delete
                                                                </button>
                                                            </MenuItem>
                                                        </MenuItems>
                                                    </Menu>
                                                </div>
                                            </td>
                                        </tr>)
                                    )}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </>
    )
}

ListCategories.layout = page => <BaseLayout children={page} title="Welcome"/>

export default ListCategories;
