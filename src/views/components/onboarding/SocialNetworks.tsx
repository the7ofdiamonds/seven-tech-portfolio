import React, { ChangeEvent, useEffect, useState } from 'react'

import { ContactMethods } from '@the7ofdiamonds/github-portfolio';
import { ProjectOnboarding } from '@the7ofdiamonds/github-portfolio';

import OptionInput from '../OptionInput';

import styles from './SocialNetworks.module.scss';

interface SocialNetworksProps {
    projectOnboarding: ProjectOnboarding | null;
    setVal: (value: ProjectOnboarding) => void;
}

const SocialNetworks: React.FC<SocialNetworksProps> = ({ projectOnboarding, setVal }) => {
    const [onboarding, setOnboarding] = useState<ProjectOnboarding>(new ProjectOnboarding);
    const [contacts, setContacts] = useState<ContactMethods>(new ContactMethods);
    const [linkedin, setLinkedin] = useState<string>(contacts.linkedin.url);
    const [x, setX] = useState<string>(contacts.x.url);
    const [instagram, setInstagram] = useState<string>(contacts.instagram.url);
    const [github, setGithub] = useState<string>(contacts.github.url);
    const [youtube, setYoutube] = useState<string>(contacts.youtube.url);

    useEffect(() => {
        if (projectOnboarding) {
            setOnboarding(projectOnboarding);
        }
    }, [projectOnboarding]);

    useEffect(() => {
        if (projectOnboarding?.contacts) {
            setContacts(projectOnboarding.contacts);
        }
    }, [projectOnboarding?.contacts]);

    useEffect(() => {
        if (projectOnboarding?.contacts?.linkedin?.url) {
            setLinkedin(projectOnboarding.contacts.linkedin.url);
        }
    }, [projectOnboarding?.contacts?.linkedin?.url]);

    useEffect(() => {
        if (projectOnboarding?.contacts?.x?.url) {
            setX(projectOnboarding.contacts.x.url);
        }
    }, [projectOnboarding?.contacts?.x?.url]);

    useEffect(() => {
        if (projectOnboarding?.contacts?.instagram?.url) {
            setInstagram(projectOnboarding.contacts.instagram.url);
        }
    }, [projectOnboarding?.contacts?.instagram?.url]);

    useEffect(() => {
        if (projectOnboarding?.contacts?.github?.url) {
            setGithub(projectOnboarding.contacts.github.url);
        }
    }, [projectOnboarding?.contacts?.github?.url]);

    useEffect(() => {
        if (projectOnboarding?.contacts?.youtube?.url) {
            setYoutube(projectOnboarding.contacts.youtube.url);
        }
    }, [projectOnboarding?.contacts?.youtube?.url]);

    const handleSocialLinkChange = (e: ChangeEvent<HTMLInputElement>) => {
        const { name, value } = e.target;

        if (name === `${contacts.linkedin.id}`) {
            setLinkedin(value)
            contacts.setContactLinkedIn(value)
        }

        if (name === `${contacts.x.id}`) {
            setX(value)
            contacts.setContactX(value)
        }

        if (name === `${contacts.instagram.id}`) {
            setInstagram(value)
            contacts.setContactInstagram(value)
        }

        if (name === `${contacts.github.id}`) {
            setGithub(value)
            contacts.setContactGitHub(value);
        }

        if (name === `${contacts.youtube.id}`) {
            setYoutube(value)
            contacts.setContactYoutube(value)
        }

        onboarding.setContacts(contacts)
        setVal(onboarding);
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
                        id={`${contacts.linkedin.id}`}
                        label={contacts.linkedin.title}
                        type={contacts.linkedin.type}
                        value={linkedin}
                        changeFunc={handleSocialLinkChange}
                    />

                    <OptionInput
                        id={`${contacts.x.id}`}
                        label={contacts.x.title}
                        type={contacts.x.type}
                        value={x}
                        changeFunc={handleSocialLinkChange}
                    />

                    <OptionInput
                        id={`${contacts.instagram.id}`}
                        label={contacts.instagram.title}
                        type={contacts.instagram.type}
                        value={instagram}
                        changeFunc={handleSocialLinkChange}
                    />

                    <OptionInput
                        id={`${contacts.github.id}`}
                        label={contacts.github.title}
                        type={contacts.github.type}
                        value={github}
                        changeFunc={handleSocialLinkChange}
                    />

                    <OptionInput
                        id={`${contacts.youtube.id}`}
                        label={contacts.youtube.title}
                        type={contacts.youtube.type}
                        value={youtube}
                        changeFunc={handleSocialLinkChange}
                    />
                </div>
            </td>
        </tr>

    )
}

export default SocialNetworks;