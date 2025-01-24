import { Fragment, useState } from 'react'
import { Dialog, DialogPanel} from '@headlessui/react'
import { Bars3Icon} from '@heroicons/react/20/solid'
import { XMarkIcon } from '@heroicons/react/24/outline'
import {Link} from "@inertiajs/react";
import { useRoute } from 'ziggy-js';
import Notification from "../Components/Notification/Notification.jsx";

const BaseLayout = ({children}) => {
    const [mobileMenuOpen, setMobileMenuOpen] = useState(false)
    const route = useRoute();

    const navigation = [
        { name: 'Home', href: route('home') },
        { name: 'Catégories', href: route('category.list') }
    ]

    return (
        <>
            <header className="absolute inset-x-0 top-0 z-50 flex h-16 border-b border-gray-900/10">
                <div className="mx-auto flex w-full max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
                    <div className="flex flex-1 items-center gap-x-6">
                        <button type="button" onClick={() => setMobileMenuOpen(true)} className="-m-3 p-3 md:hidden">
                            <span className="sr-only">Open main menu</span>
                            <Bars3Icon aria-hidden="true" className="size-5 text-gray-900" />
                        </button>
                        <img
                            alt="Your Company"
                            src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600"
                            className="h-8 w-auto"
                        />
                    </div>
                    <nav className="hidden md:flex md:gap-x-11 md:text-sm/6 md:font-semibold md:text-gray-700">
                        {navigation.map((item, itemIdx) => (
                            <Link key={itemIdx} href={item.href}>
                                {item.name}
                            </Link>
                        ))}
                    </nav>
                </div>
                <Dialog open={mobileMenuOpen} onClose={setMobileMenuOpen} className="lg:hidden">
                    <div className="fixed inset-0 z-50" />
                    <DialogPanel className="fixed inset-y-0 left-0 z-50 w-full overflow-y-auto bg-white px-4 pb-6 sm:max-w-sm sm:px-6 sm:ring-1 sm:ring-gray-900/10">
                        <div className="-ml-0.5 flex h-16 items-center gap-x-6">
                            <button type="button" onClick={() => setMobileMenuOpen(false)} className="-m-2.5 p-2.5 text-gray-700">
                                <span className="sr-only">Close menu</span>
                                <XMarkIcon aria-hidden="true" className="size-6" />
                            </button>
                            <div className="-ml-0.5">
                                <a href="#" className="-m-1.5 block p-1.5">
                                    <span className="sr-only">Your Company</span>
                                    <img
                                        alt=""
                                        src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600"
                                        className="h-8 w-auto"
                                    />
                                </a>
                            </div>
                        </div>
                        <div className="mt-2 space-y-2">
                            {navigation.map((item) => (
                                <a
                                    key={item.name}
                                    href={item.href}
                                    className="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50"
                                >
                                    {item.name}
                                </a>
                            ))}
                        </div>
                    </DialogPanel>
                </Dialog>
            </header>

            <main>
                <div className="space-y-16 py-16 xl:space-y-20">
                    <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div className="mx-auto max-w-2xl lg:mx-0 lg:max-w-none mt-3">
                            {children}
                        </div>
                    </div>
                </div>
                <Notification />
            </main>
        </>
    )
}

export default BaseLayout
