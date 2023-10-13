---
tags: [Notebooks/Learning/AZ900/2023-10]
title: 3 - Azure Management and Governance
created: '2023-10-12T08:09:16.077Z'
modified: '2023-10-13T13:26:57.312Z'
---

# 3 - Azure Management and Governance
[MS Learn](https://learn.microsoft.com/en-us/training/paths/describe-azure-management-governance/)
*30%-35%*

## Insight in Cost
Factors affecting costs:
- **Resource Type** costs are resource specific.
- **Consumption** specifically with the pay as-you-go-model.
- **Maintenance** monitoring your footprint and maintaining your environment can mitigate cost.
- **Geography** 
- **Network traffic** (some) inboud data is free. Cost for outbound data or data between Azure resources is impacted by billing zone
- **Subscription** licensing costs

**Azure Market Place** allows customers to find, try, purchase and provision applications and services from hunderds of leading service providers, which are all certified to run on Azure. Such like:
- Open source container
- Virtual machine and database images
- Application build and deployment tools
- Developer tools

[**Pricing Calculator**](https://azure.microsoft.com/en-gb/pricing/calculator/) estimate the cost of running a setup in Azure.

[**Total Cost of Ownership Calculator**](https://azure.microsoft.com/pricing/tco/calculator) compares the cost of running a workload in your datacenter versus on Azure.

**Azure Cost Management**
- Reporting - billing reports
- Data Enrichment
- Budgets - set spend budget 
- Alerting - When costs exceed limits
- Recommendations

## Governance

**Azure Policy** helps to enforce organisational standards to assess compliance at-scale. Provides governance and resource consistency with regulatory compliance, security, cost and management.
- Evaluates and identifies Azure resources that do not comply with your policies.
- Provides built-in policy and initiative definitions.

An **initiative** is a collection of policies.

**Azure Blueprints** makes it possible for development teams to rapidly build and stand up new environments. Development teams can quickly build trust to organisational compliance with a set of built-in components (such as networking) in order to speed up development and delivery. It can be used for different kind of components such as role assignment, policy assignment, azure resource manager templates, resource groups.

**Resource Lock** protect your Azure resources from accidental deletion or modification. These can be set with subscription, resource group, or individual resource level.
- *Delete* you can't delete
- *Read-only* you can't modify or delete

**Service Trust Portal** a webportal in which Microsoft has all the compliance 'paperwork'.

**Microsoft Purview** is a family of data governance risk and compliance solutions that helps you get a single unified view into your data. It brings insights about your on-premises, multi-cloud and software as a service data together.
- Automated data discovery
- Sensitive data classification
- End-to-end data lineage

## Management

**Tools for interacting with Azure**
*For the exam you need to be able to differentiate between PowerShell and BASH*
- Azure portal
- Azure Cloud Shell
- Azure Powershell
- Comamand-Line Interface

**Azure Arc** an agent you can install on on-premise or in non-Azure Cloud machines to manage these from your Azure Cloud.

**Azure Resource Manager** provides a managemnt layer that enables you to create, update and delete resources in your Azure subscription.

**Infrastructure as code** 
- Ensures consistency in deployment across your cloud ecosystem.
- Manage configuration at scale
- Rapidly provision additional environments based on standard configuration and build

**Azure Resource Mangemer (ARM) template** JSON files that can be used to create and deploy Azure infrastructure without having to write programming commands
- Declarative syntax
- Repeatable results
- Ochestration
- Modular files
- Built-in validation
- Exportable code

**BICEP** also a scripting language, more compact than JSON. Microsoft started to implement it, so not yet fully functional

### Monitoring
**Azure Advisor** analyses and gives recommendations based on best practices
- Reliability
- Security
- Performance
- Cost 
- Operational excellence

**Azure Service Health** is a collection of services that keep you infromed of general Azure status, service status that may impact you and specific resource status that is impacting you
- *Azure Status* Global view of the health of all Azure services across all Azure regions
- *Service Health* focused view on only the services and regions that you are using. If a service is experiencing a problem in a region you are not using it won't show up.
- *Resource health* tailored view of your actual Azure resources. It provides information about the health of your individual cloud resources.


