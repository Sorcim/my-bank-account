import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/react'
import { EllipsisHorizontalIcon } from '@heroicons/react/20/solid'
import {useModal} from "../../Contexts/ModalContext.jsx";
import BankAccountDeleteForm from "./BankAccountDeleteForm.jsx";
import BankAccountEditForm from "./BankAccountEditForm.jsx";
import {Link} from "@inertiajs/react";
import Amount from "../Amount.jsx";
import Time from "../Time.jsx";



const BankAccountCard = ({bankAccount}) => {
    const {openModal} = useModal()
    return (
        <li key={bankAccount.id} className="overflow-hidden rounded-xl border border-gray-200">
            <div className="flex items-center gap-x-4 border-b border-gray-900/5 bg-gray-50 p-6">
                {/*<img*/}
                {/*    alt={client.name}*/}
                {/*    src={client.imageUrl}*/}
                {/*    className="size-12 flex-none rounded-lg bg-white object-cover ring-1 ring-gray-900/10"*/}
                {/*/>*/}
                <Link  href={route('bank-account.show', bankAccount.id)}>
                    <div className="text-sm/6 font-medium text-gray-900">{bankAccount.name}</div>
                </Link>
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
                                className="block w-full px-3 py-1 text-sm/6 text-gray-900 data-[focus]:bg-gray-50 data-[focus]:outline-none"
                                onClick={() => openModal(<BankAccountEditForm bankAccount={bankAccount}/>)}
                            >
                                Edit<span className="sr-only">, {bankAccount.name}</span>
                            </button>
                        </MenuItem>
                        <MenuItem>
                            <button
                                className="block w-full px-3 py-1 text-sm/6 text-red-500 data-[focus]:bg-gray-50 data-[focus]:outline-none"
                                onClick={() => openModal(<BankAccountDeleteForm bankAccount={bankAccount}/>)}
                            >
                                Delete<span className="sr-only">, {bankAccount.name}</span>
                            </button>
                        </MenuItem>
                    </MenuItems>
                </Menu>
            </div>
            <dl className="-my-3 divide-y divide-gray-100 px-6 py-4 text-sm/6">
                <div className="flex justify-between gap-x-4 py-3">
                    <dt className="text-gray-500">Total sur le compte</dt>
                    <dd className="flex items-start gap-x-2">
                        <div className="font-medium text-gray-900"><Amount amount={bankAccount.currentBalance}/></div>
                    </dd>
                </div>
                <div className="flex justify-between gap-x-4 py-3">
                    <dt className="text-gray-500">Dernière transaction</dt>
                    <dd className="text-gray-700">
                        <Time date={bankAccount.lastTransactionDate?.date} />
                    </dd>
                </div>
            </dl>
        </li>
    )
}

export default BankAccountCard
