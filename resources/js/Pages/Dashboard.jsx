import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { useState } from "react";
import { Inertia } from '@inertiajs/inertia';
import axios from 'axios';

export default function Dashboard( props ) {
    const [title, setTitle] = useState("");
    const [description, setDescription] = useState("");

    const handleSubmit = () => {
        const datas = {
            title, description
        }
        Inertia.post('api/posts/create', datas)
    };


    return (
        <AuthenticatedLayout
            user={props.auth}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Postingan Saya
                </h2>
            }
        >
            <Head title="Dashboard" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <input
                            id="name"
                            type="text"
                            placeholder="Title"
                            className="m-2 input input-bordered w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            required
                            autoFocus
                            onChange={(title) => setTitle(title.target.value)}
                        ></input>
                        <textarea
                            className="textarea textarea-bordered w-full m-2"
                            placeholder="Deskripsi"
                            required
                            onChange={(description) =>
                                setDescription(description.target.value)
                            }
                        ></textarea>
                        <input
                            type="file"
                            className="file-input file-input-bordered w-full m-2"
                        />
                        <button className="btn btn-inline m-2" onClick={() => handleSubmit()}>Create</button>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
