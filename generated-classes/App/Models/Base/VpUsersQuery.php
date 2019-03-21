<?php

namespace App\Models\Base;

use \Exception;
use \PDO;
use App\Models\VpUsers as ChildVpUsers;
use App\Models\VpUsersQuery as ChildVpUsersQuery;
use App\Models\Map\VpUsersTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'vp_users' table.
 *
 *
 *
 * @method     ChildVpUsersQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildVpUsersQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     ChildVpUsersQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 * @method     ChildVpUsersQuery orderByEmail($order = Criteria::ASC) Order by the email column
 *
 * @method     ChildVpUsersQuery groupById() Group by the id column
 * @method     ChildVpUsersQuery groupByFirstName() Group by the first_name column
 * @method     ChildVpUsersQuery groupByLastName() Group by the last_name column
 * @method     ChildVpUsersQuery groupByEmail() Group by the email column
 *
 * @method     ChildVpUsersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVpUsersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVpUsersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVpUsersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVpUsersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVpUsersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVpUsersQuery leftJoinVpUsersPlans($relationAlias = null) Adds a LEFT JOIN clause to the query using the VpUsersPlans relation
 * @method     ChildVpUsersQuery rightJoinVpUsersPlans($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VpUsersPlans relation
 * @method     ChildVpUsersQuery innerJoinVpUsersPlans($relationAlias = null) Adds a INNER JOIN clause to the query using the VpUsersPlans relation
 *
 * @method     ChildVpUsersQuery joinWithVpUsersPlans($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VpUsersPlans relation
 *
 * @method     ChildVpUsersQuery leftJoinWithVpUsersPlans() Adds a LEFT JOIN clause and with to the query using the VpUsersPlans relation
 * @method     ChildVpUsersQuery rightJoinWithVpUsersPlans() Adds a RIGHT JOIN clause and with to the query using the VpUsersPlans relation
 * @method     ChildVpUsersQuery innerJoinWithVpUsersPlans() Adds a INNER JOIN clause and with to the query using the VpUsersPlans relation
 *
 * @method     \App\Models\VpUsersPlansQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVpUsers findOne(ConnectionInterface $con = null) Return the first ChildVpUsers matching the query
 * @method     ChildVpUsers findOneOrCreate(ConnectionInterface $con = null) Return the first ChildVpUsers matching the query, or a new ChildVpUsers object populated from the query conditions when no match is found
 *
 * @method     ChildVpUsers findOneById(int $id) Return the first ChildVpUsers filtered by the id column
 * @method     ChildVpUsers findOneByFirstName(string $first_name) Return the first ChildVpUsers filtered by the first_name column
 * @method     ChildVpUsers findOneByLastName(string $last_name) Return the first ChildVpUsers filtered by the last_name column
 * @method     ChildVpUsers findOneByEmail(string $email) Return the first ChildVpUsers filtered by the email column *

 * @method     ChildVpUsers requirePk($key, ConnectionInterface $con = null) Return the ChildVpUsers by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVpUsers requireOne(ConnectionInterface $con = null) Return the first ChildVpUsers matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVpUsers requireOneById(int $id) Return the first ChildVpUsers filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVpUsers requireOneByFirstName(string $first_name) Return the first ChildVpUsers filtered by the first_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVpUsers requireOneByLastName(string $last_name) Return the first ChildVpUsers filtered by the last_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVpUsers requireOneByEmail(string $email) Return the first ChildVpUsers filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVpUsers[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildVpUsers objects based on current ModelCriteria
 * @method     ChildVpUsers[]|ObjectCollection findById(int $id) Return ChildVpUsers objects filtered by the id column
 * @method     ChildVpUsers[]|ObjectCollection findByFirstName(string $first_name) Return ChildVpUsers objects filtered by the first_name column
 * @method     ChildVpUsers[]|ObjectCollection findByLastName(string $last_name) Return ChildVpUsers objects filtered by the last_name column
 * @method     ChildVpUsers[]|ObjectCollection findByEmail(string $email) Return ChildVpUsers objects filtered by the email column
 * @method     ChildVpUsers[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VpUsersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Models\Base\VpUsersQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Models\\VpUsers', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVpUsersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVpUsersQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildVpUsersQuery) {
            return $criteria;
        }
        $query = new ChildVpUsersQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildVpUsers|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VpUsersTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = VpUsersTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVpUsers A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, first_name, last_name, email FROM vp_users WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildVpUsers $obj */
            $obj = new ChildVpUsers();
            $obj->hydrate($row);
            VpUsersTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildVpUsers|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildVpUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VpUsersTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildVpUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VpUsersTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVpUsersQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(VpUsersTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(VpUsersTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VpUsersTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the first_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstName('fooValue');   // WHERE first_name = 'fooValue'
     * $query->filterByFirstName('%fooValue%', Criteria::LIKE); // WHERE first_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVpUsersQuery The current query, for fluid interface
     */
    public function filterByFirstName($firstName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VpUsersTableMap::COL_FIRST_NAME, $firstName, $comparison);
    }

    /**
     * Filter the query on the last_name column
     *
     * Example usage:
     * <code>
     * $query->filterByLastName('fooValue');   // WHERE last_name = 'fooValue'
     * $query->filterByLastName('%fooValue%', Criteria::LIKE); // WHERE last_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVpUsersQuery The current query, for fluid interface
     */
    public function filterByLastName($lastName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VpUsersTableMap::COL_LAST_NAME, $lastName, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVpUsersQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VpUsersTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query by a related \App\Models\VpUsersPlans object
     *
     * @param \App\Models\VpUsersPlans|ObjectCollection $vpUsersPlans the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildVpUsersQuery The current query, for fluid interface
     */
    public function filterByVpUsersPlans($vpUsersPlans, $comparison = null)
    {
        if ($vpUsersPlans instanceof \App\Models\VpUsersPlans) {
            return $this
                ->addUsingAlias(VpUsersTableMap::COL_ID, $vpUsersPlans->getUserId(), $comparison);
        } elseif ($vpUsersPlans instanceof ObjectCollection) {
            return $this
                ->useVpUsersPlansQuery()
                ->filterByPrimaryKeys($vpUsersPlans->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByVpUsersPlans() only accepts arguments of type \App\Models\VpUsersPlans or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VpUsersPlans relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildVpUsersQuery The current query, for fluid interface
     */
    public function joinVpUsersPlans($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VpUsersPlans');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'VpUsersPlans');
        }

        return $this;
    }

    /**
     * Use the VpUsersPlans relation VpUsersPlans object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Models\VpUsersPlansQuery A secondary query class using the current class as primary query
     */
    public function useVpUsersPlansQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVpUsersPlans($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VpUsersPlans', '\App\Models\VpUsersPlansQuery');
    }

    /**
     * Filter the query by a related VpPlans object
     * using the vp_users_plans table as cross reference
     *
     * @param VpPlans $vpPlans the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildVpUsersQuery The current query, for fluid interface
     */
    public function filterByVpPlans($vpPlans, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useVpUsersPlansQuery()
            ->filterByVpPlans($vpPlans, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ChildVpUsers $vpUsers Object to remove from the list of results
     *
     * @return $this|ChildVpUsersQuery The current query, for fluid interface
     */
    public function prune($vpUsers = null)
    {
        if ($vpUsers) {
            $this->addUsingAlias(VpUsersTableMap::COL_ID, $vpUsers->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the vp_users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VpUsersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VpUsersTableMap::clearInstancePool();
            VpUsersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VpUsersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VpUsersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VpUsersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VpUsersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // VpUsersQuery
