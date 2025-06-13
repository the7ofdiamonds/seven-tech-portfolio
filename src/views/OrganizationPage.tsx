import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';

import { OrganizationComponent, PortfolioComponent } from '@the7ofdiamonds/github-portfolio';

import { ContactBar } from '@the7ofdiamonds/github-portfolio';

import { getOrganization } from '@the7ofdiamonds/github-portfolio';

import { useAppDispatch, useAppSelector } from '@/model/hooks';

import { Organization, Portfolio, Skills } from '@the7ofdiamonds/github-portfolio';

import styles from '@/views/components/Organization.module.scss';

const OrganizationPage: React.FC = () => {
    const dispatch = useAppDispatch();

    const { login } = useParams<string>();

    const { organizationObject } = useAppSelector(
        (state) => state.organization);

    const [organization, setOrganization] = useState<Organization | null>(null);
    const [portfolio, setPortfolio] = useState<Portfolio | null>(null);
    const [skills, setSkills] = useState<Skills | null>(null);

    useEffect(() => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }, [login]);

    useEffect(() => {
        if (!organizationObject && login) {
            dispatch(getOrganization(login));
        }
    }, [login, organizationObject]);

    useEffect(() => {
        if (organizationObject) {
            setOrganization(new Organization(organizationObject));
        }
    }, [organizationObject]);

    useEffect(() => {
        if (organization && organization.name) {
            document.title = organization.name
        }
    }, [organization]);

    useEffect(() => {
        if (organization && organization.portfolio) {
            setPortfolio(organization.portfolio)
        }
    }, [organization?.portfolio]);

    useEffect(() => {
        if (organization && organization.skills) {
            setSkills(organization.skills)
        }
    }, [organization?.skills]);

    return (
        <section className={styles.organization} id='top'>
            <>
                {organization && <OrganizationComponent organization={organization} />}

                {organization && organization.contactMethods && <ContactBar contactMethods={organization.contactMethods} location='' />}

                {organization && <PortfolioComponent portfolio={portfolio} skills={skills} />}
            </>
        </section>
    )
}

export default OrganizationPage;