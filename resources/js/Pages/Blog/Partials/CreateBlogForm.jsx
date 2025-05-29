import { useForm } from '@inertiajs/react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import TextAreaInput from '@/Components/TextAreaInput';

import * as yup from 'yup';
import { useState } from 'react';

const schema = yup.object({
    title: yup.string().required('Title is required.'),
    content: yup.string().required('Content is required.'),
});

export default function CreateBlogForm({ className = '' }) {
    const {
        data,
        setData,
        post,
        processing,
        errors: serverErrors,
        reset
    } = useForm({
        title: "",
        content: "",
    });

    const [localErrors, setLocalErrors] = useState({});

    async function handleSubmit(e) {
        e.preventDefault();
        try {
            await schema.validate(data, { abortEarly: false }); // Validate all fields
            setLocalErrors({}); // Clear local errors if valid

            post('/blog/store', {
                onSuccess: () => reset(),
            });

        } catch (err) {
            if (err.name === 'ValidationError') {
                const formattedErrors = {};
                err.inner.forEach((e) => {
                    formattedErrors[e.path] = e.message;
                });
                setLocalErrors(formattedErrors);
            }
        }
    }

    return (
        <section className={className}>
            <form onSubmit={handleSubmit} className="mt-6 space-y-6">
                <div>
                    <InputLabel htmlFor="title" value="Title" />
                    <TextInput
                        id="title"
                        onChange={(e) => setData('title', e.target.value)}
                        type="text"
                        className="mt-1 block w-full"
                    />
                    <InputError message={localErrors.title || serverErrors.title} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="content" value="Content" />
                    <TextAreaInput
                        id="content"
                        onChange={(e) => setData('content', e.target.value)}
                        className="mt-1 block w-full"
                    />
                    <InputError message={localErrors.content || serverErrors.content} className="mt-2" />
                </div>

                <div className="flex items-center gap-4">
                    <PrimaryButton disabled={processing}>Save</PrimaryButton>
                </div>
            </form>
        </section>
    );
}
