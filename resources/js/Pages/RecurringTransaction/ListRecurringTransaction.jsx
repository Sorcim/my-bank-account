import BaseLayout from "../../Layout/BaseLayout.jsx";
import {Fragment} from "react";
import Amount from "../../Components/Amount.jsx";
import {Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/react";
import {EllipsisHorizontalIcon} from "@heroicons/react/20/solid/index.js";
import {useModal} from "../../Contexts/ModalContext.jsx";
import Pagination from "../../Components/Pagination/Pagination.jsx";
import {ChevronLeftIcon, ChevronRightIcon} from "@heroicons/react/16/solid/index.js";
import RecurringTransactionAddButton from "../../Components/RecurringTransaction/RecurringTransactionAddButton.jsx";
import RecurringTransactionDeleteForm from "../../Components/RecurringTransaction/RecurringTransactionDeleteForm.jsx";
import RecurringTransactionEditForm from "../../Components/RecurringTransaction/RecurringTransactionEditForm.jsx";
import Time from "../../Components/Time.jsx";

const ListRecurringTransaction = ({recurringTransactions, categories, bankAccounts}) => {
    const {openModal} = useModal()
    return (
        <>
            <div>
                <div>
                    <nav aria-label="Back" className="sm:hidden">
                        <a href="#" className="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
                            <ChevronLeftIcon aria-hidden="true" className="-ml-1 mr-1 size-5 shrink-0 text-gray-400"/>
                            Back
                        </a>
                    </nav>
                    <nav aria-label="Breadcrumb" className="hidden sm:flex">
                        <ol role="list" className="flex items-center space-x-4">
                            <li>
                                <div className="flex">
                                    <a href="#" className="text-sm font-medium text-gray-500 hover:text-gray-700">
                                        Compte bancaire
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div className="flex items-center">
                                    <ChevronRightIcon aria-hidden="true" className="size-5 shrink-0 text-gray-400"/>
                                    <a href="#" className="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">
                                        Transactions Récurrentes
                                    </a>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div className="mt-2 md:flex md:items-center md:justify-between">
                    <div className="min-w-0 flex-1">
                        <h2 className="text-2xl/7 font-bold text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                            Transaction List
                        </h2>
                    </div>
                    <RecurringTransactionAddButton bankAccounts={bankAccounts} categories={categories}/>
                </div>
            </div>
            <div className="mt-6 overflow-hidden border-t border-gray-100">
                <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div className="mx-auto max-w-2xl lg:mx-0 lg:max-w-none">
                        <table className="w-full text-left mb-3">
                            <tbody>
                            {recurringTransactions.transactions.map((transaction) =>
                                (<tr key={transaction.id}>
                                    <td className="py-5 pr-6">
                                        <div className="flex gap-x-6">
                                            <div className="flex-auto">
                                                <div className="flex items-start gap-x-3">
                                                    <div
                                                        className="text-sm/6 font-medium text-gray-900"><Amount
                                                        amount={transaction.amount}/></div>
                                                </div>
                                                <div
                                                    className="mt-1 text-xs/5 text-gray-500">
                                                    <span>{bankAccounts.map((bankAccount) => {
                                                        if (bankAccount.id === transaction.bankAccountId) {
                                                            return bankAccount.name
                                                        }
                                                    })}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            className="absolute bottom-0 right-full h-px w-screen bg-gray-100"/>
                                        <div className="absolute bottom-0 left-0 h-px w-screen bg-gray-100"/>
                                    </td>
                                    <td className="hidden py-5 pr-6 sm:table-cell">
                                        <div className="text-sm/6 text-gray-900">{transaction.description}</div>
                                        {categories.map((category) => {
                                            if (category.id === transaction.categoryId) {
                                                return (
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
                                                )
                                            }
                                        })}
                                    </td>
                                    <td className="relative py-5 pr-6">
                                        <div className="flex gap-x-6">
                                            <div className="flex-auto">
                                                <div
                                                    className="mt-1 text-xs/5 text-gray-500">{transaction.frequency}
                                                </div>
                                                <div
                                                    className="mt-1 text-xs/5 text-gray-500">next: <Time
                                                    date={transaction.nextProcessedAt.date}/>
                                                </div>
                                                <div
                                                    className="mt-1 text-xs/5 text-gray-500">end: <Time
                                                    date={transaction.endAt.date}/>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            className="absolute bottom-0 right-full h-px w-screen bg-gray-100"/>
                                        <div className="absolute bottom-0 left-0 h-px w-screen bg-gray-100"/>
                                    </td>
                                    <td className="py-5 text-right">
                                        <div className="flex justify-end">
                                            <Menu as="div" className="relative ml-auto">
                                                <MenuButton
                                                    className="-m-2.5 block p-2.5 text-gray-400 hover:text-gray-500">
                                                    <span className="sr-only">Open options</span>
                                                    <EllipsisHorizontalIcon aria-hidden="true" className="size-5"/>
                                                </MenuButton>
                                                <MenuItems
                                                    transition
                                                    className="absolute right-0 z-10 mt-0.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 transition focus:outline-none data-[closed]:scale-95 data-[closed]:transform data-[closed]:opacity-0 data-[enter]:duration-100 data-[leave]:duration-75 data-[enter]:ease-out data-[leave]:ease-in"
                                                >
                                                    <MenuItem>
                                                        <button
                                                            onClick={() => openModal(<RecurringTransactionEditForm
                                                                bankAccounts={bankAccounts}
                                                                categories={categories}
                                                                transaction={transaction}/>)}
                                                            className="block w-full px-3 py-1 text-sm/6 text-gray-900 data-[focus]:bg-gray-50 data-[focus]:outline-none"
                                                        >
                                                            Edit
                                                        </button>
                                                    </MenuItem>
                                                    <MenuItem>
                                                        <button
                                                            className="block w-full px-3 py-1 text-sm/6 text-red-500 data-[focus]:bg-gray-50 data-[focus]:outline-none"
                                                            onClick={() => openModal(<RecurringTransactionDeleteForm
                                                                transaction={transaction}/>)}
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
                        <Pagination currentPage={recurringTransactions.currentPage}
                                    lastPage={recurringTransactions.lastPage}
                                    paginationNumbers={recurringTransactions.paginationNumbers}/>
                    </div>
                </div>
            </div>
        </>
    )
}

ListRecurringTransaction.layout = page => <BaseLayout children={page} title="Welcome"/>

export default ListRecurringTransaction;
