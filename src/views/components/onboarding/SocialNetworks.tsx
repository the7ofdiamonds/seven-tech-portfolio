import React, { ChangeEvent, useState } from 'react'

import { Contact, ContactMethods } from '@the7ofdiamonds/github-portfolio';

import OptionInput from '../OptionInput';

import styles from './SocialNetworks.module.scss';

interface SocialNetworksProps {
    socialNetworks: ContactMethods | null;
}

const SocialNetworks: React.FC<SocialNetworksProps> = ({ socialNetworks }) => {
    const [contacts, setContacts] = useState<ContactMethods>(new ContactMethods);
    const [linkedin, setLinkedin] = useState<Contact>(new Contact({ id: 'linkedIn', title: 'LinkedIn' }));
    const [x, setX] = useState<Contact>(new Contact({ id: 'x', title: 'X' }));
    const [instagram, setInstagram] = useState<Contact>(new Contact({ id: 'instagram', title: 'Instagram' }));
    const [github, setGithub] = useState<Contact>(new Contact({ id: 'gitHub', title: 'GitHub' }));
    const [youtube, setYoutube] = useState<Contact>(new Contact({ id: 'youtube', title: 'YouTube' }));
    const [website, setWebsite] = useState<Contact>(new Contact({ id: 'website', title: 'Website' }));
    const [email, setEmail] = useState<Contact>(new Contact({ id: 'email', title: 'Email' }));
    const [phone, setPhone] = useState<Contact>(new Contact({ id: 'phone', title: 'Phone' }));

    const handleSocialLinkChange = (e: ChangeEvent<HTMLInputElement>) => {
        const { name, value } = e.target;

        if (name === `social_networks_${linkedin.id}`) {
            linkedin.setURL(value);
            setLinkedin(linkedin);
            contacts.setContactLinkedIn(value)
        }

        if (name === `social_networks_${x.id}`) {
            x.setURL(value); instagram
            setX(x);
            contacts.setContactX(value)
        }

        if (name === `social_networks_${instagram.id}`) {
            instagram.setURL(value);
            setInstagram(instagram);
            contacts.setContactInstagram(value)
        }

        if (name === `social_networks_${github.id}`) {
            github.setURL(value);
            setGithub(github);
            contacts.setContactGitHub(value);
        }

        if (name === `social_networks_${youtube.id}`) {
            youtube.setURL(value);
            setYoutube(youtube);
            contacts.setContactYoutube(value)
        }

        if (name === `social_networks_${website.id}`) {
            website.setURL(value);
            setWebsite(website);
            contacts.setContactWebsite(value)
        }

        if (name === `social_networks_${email.id}`) {
            email.setURL(value);
            setEmail(email);
            contacts.setContactEmail(value)
        }

        if (name === `social_networks_${phone.id}`) {
            phone.setURL(value);
            setPhone(phone);
            contacts.setContactPhone(value)
        }

        setContacts(contacts);
    };

    return (
        <tr id="social_networks">
            <td>
                <label htmlFor="social_networks">
                    Does (your company or organization) have social media
                    pages? If Yes, provide a link to them below.
                </label>
                <div className={styles.options}>

                    <OptionInput
                        id={`social_networks_${linkedin.id}`}
                        label={linkedin.title ?? ''}
                        type={'url'}
                        value={linkedin.url ?? ''}
                        changeFunc={handleSocialLinkChange}
                    />

                    <OptionInput
                        id={`social_networks_${x.id}`}
                        label={x.title ?? ''}
                        type={'url'}
                        value={x.url ?? ''}
                        changeFunc={handleSocialLinkChange}
                    />

                    <OptionInput
                        id={`social_networks_${instagram.id}`}
                        label={instagram.title ?? ''}
                        type={'url'}
                        value={instagram.url ?? ''}
                        changeFunc={handleSocialLinkChange}
                    />

                    <OptionInput
                        id={`social_networks_${github.id}`}
                        label={github.title ?? ''}
                        type={'url'}
                        value={github.url ?? ''}
                        changeFunc={handleSocialLinkChange}
                    />

                    <OptionInput
                        id={`social_networks_${youtube.id}`}
                        label={youtube.title ?? ''}
                        type={'url'}
                        value={youtube.url ?? ''}
                        changeFunc={handleSocialLinkChange}
                    />

                    <OptionInput
                        id={`social_networks_${website.id}`}
                        label={website.title ?? ''}
                        type={'url'}
                        value={website.url ?? ''}
                        changeFunc={handleSocialLinkChange}
                    />

                    <OptionInput
                        id={`social_networks_${email.id}`}
                        label={email.title ?? ''}
                        type={'email'}
                        value={email.url ?? ''}
                        changeFunc={handleSocialLinkChange}
                    />

                    <OptionInput
                        id={`social_networks_${phone.id}`}
                        label={phone.title ?? ''}
                        type={'phone'}
                        value={phone.url ?? ''}
                        changeFunc={handleSocialLinkChange}
                    />
                </div>
            </td>
        </tr>

    )
}

export default SocialNetworks;