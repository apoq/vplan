<?php

namespace App\Models\Base;

use \Exception;
use \PDO;
use App\Models\VpDays as ChildVpDays;
use App\Models\VpDaysQuery as ChildVpDaysQuery;
use App\Models\Map\VpDaysTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'vp_days' table.
 *
 *
 *
 * @method     ChildVpDaysQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildVpDaysQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildVpDaysQuery orderByPlanId($order = Criteria::ASC) Order by the plan_id column
 *
 * @method     ChildVpDaysQuery groupById() Group by the id column
 * @method     ChildVpDaysQuery groupByTitle() Group by the title column
 * @method     ChildVpDaysQuery groupByPlanId() Group by the plan_id column
 *
 * @method     ChildVpDaysQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVpDaysQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVpDaysQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVpDaysQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVpDaysQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVpDaysQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVpDaysQuery leftJoinVpPlans($relationAlias = null) Adds a LEFT JOIN clause to the query using the VpPlans relation
 * @method     ChildVpDaysQuery rightJoinVpPlans($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VpPlans relation
 * @method     ChildVpDaysQuery innerJoinVpPlans($relationAlias = null) Adds a INNER JOIN clause to the query using the VpPlans relation
 *
 * @method     ChildVpDaysQuery joinWithVpPlans($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VpPlans relation
 *
 * @method     ChildVpDaysQuery leftJoinWithVpPlans() Adds a LEFT JOIN clause and with to the query using the VpPlans relation
 * @method     ChildVpDaysQuery rightJoinWithVpPlans() Adds a RIGHT JOIN clause and with to the query using the VpPlans relation
 * @method     ChildVpDaysQuery innerJoinWithVpPlans() Adds a INNER JOIN clause and with to the query using the VpPlans relation
 *
 * @method     ChildVpDaysQuery leftJoinVpExercises($relationAlias = null) Adds a LEFT JOIN clause to the query using the VpExercises relation
 * @method     ChildVpDaysQuery rightJoinVpExercises($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VpExercises relation
 * @method     ChildVpDaysQuery innerJoinVpExercises($relationAlias = null) Adds a INNER JOIN clause to the query using the VpExercises relation
 *
 * @method     ChildVpDaysQuery joinWithVpExercises($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VpExercises relation
 *
 * @method     ChildVpDaysQuery leftJoinWithVpExercises() Adds a LEFT JOIN clause and with to the query using the VpExercises relation
 * @method     ChildVpDaysQuery rightJoinWithVpExercises() Adds a RIGHT JOIN clause and with to the query using the VpExercises relation
 * @method     ChildVpDaysQuery innerJoinWithVpExercises() Adds a INNER JOIN clause and with to the query using the VpExercises relation
 *
 * @method     \App\Models\VpPlansQuery|\App\Models\VpExercisesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVpDays findOne(ConnectionInterface $con = null) Return the first ChildVpDays matching the query
 * @method     ChildVpDays findOneOrCreate(ConnectionInterface $con = null) Return the first ChildVpDays matching the query, or a new ChildVpDays object populated from the query conditions when no match is found
 *
 * @method     ChildVpDays findOneById(string $id) Return the first ChildVpDays filtered by the id column
 * @method     ChildVpDays findOneByTitle(string $title) Return the first ChildVpDays filtered by the title column
 * @method     ChildVpDays findOneByPlanId(string $plan_id) Return the first ChildVpDays filtered by the plan_id column *

 * @method     ChildVpDays requirePk($key, ConnectionInterface $con = null) Return the ChildVpDays by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVpDays requireOne(ConnectionInterface $con = null) Return the first ChildVpDays matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVpDays requireOneById(string $id) Return the first ChildVpDays filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVpDays requireOneByTitle(string $title) Return the first ChildVpDays filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVpDays requireOneByPlanId(string $plan_id) Return the first ChildVpDays filtered by the plan_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVpDays[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildVpDays objects based on current ModelCriteria
 * @method     ChildVpDays[]|ObjectCollection findById(string $id) Return ChildVpDays objects filtered by the id column
 * @method     ChildVpDays[]|ObjectCollection findByTitle(string $title) Return ChildVpDays objects filtered by the title column
 * @method     ChildVpDays[]|ObjectCollection findByPlanId(string $plan_id) Return ChildVpDays objects filtered by the plan_id column
 * @method     ChildVpDays[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VpDaysQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Models\Base\VpDaysQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Models\\VpDays', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVpDaysQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVpDaysQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildVpDaysQuery) {
            return $criteria;
        }
        $query = new ChildVpDaysQuery();
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
     * @return ChildVpDays|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VpDaysTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = VpDaysTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildVpDays A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, title, plan_id FROM vp_days WHERE id = :p0';
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
            /** @var ChildVpDays $obj */
            $obj = new ChildVpDays();
            $obj->hydrate($row);
            VpDaysTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildVpDays|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildVpDaysQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VpDaysTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildVpDaysQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VpDaysTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildVpDaysQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(VpDaysTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(VpDaysTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VpDaysTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%', Criteria::LIKE); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVpDaysQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VpDaysTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the plan_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPlanId(1234); // WHERE plan_id = 1234
     * $query->filterByPlanId(array(12, 34)); // WHERE plan_id IN (12, 34)
     * $query->filterByPlanId(array('min' => 12)); // WHERE plan_id > 12
     * </code>
     *
     * @see       filterByVpPlans()
     *
     * @param     mixed $planId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVpDaysQuery The current query, for fluid interface
     */
    public function filterByPlanId($planId = null, $comparison = null)
    {
        if (is_array($planId)) {
            $useMinMax = false;
            if (isset($planId['min'])) {
                $this->addUsingAlias(VpDaysTableMap::COL_PLAN_ID, $planId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($planId['max'])) {
                $this->addUsingAlias(VpDaysTableMap::COL_PLAN_ID, $planId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VpDaysTableMap::COL_PLAN_ID, $planId, $comparison);
    }

    /**
     * Filter the query by a related \App\Models\VpPlans object
     *
     * @param \App\Models\VpPlans|ObjectCollection $vpPlans The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVpDaysQuery The current query, for fluid interface
     */
    public function filterByVpPlans($vpPlans, $comparison = null)
    {
        if ($vpPlans instanceof \App\Models\VpPlans) {
            return $this
                ->addUsingAlias(VpDaysTableMap::COL_PLAN_ID, $vpPlans->getId(), $comparison);
        } elseif ($vpPlans instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VpDaysTableMap::COL_PLAN_ID, $vpPlans->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByVpPlans() only accepts arguments of type \App\Models\VpPlans or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VpPlans relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildVpDaysQuery The current query, for fluid interface
     */
    public function joinVpPlans($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VpPlans');

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
            $this->addJoinObject($join, 'VpPlans');
        }

        return $this;
    }

    /**
     * Use the VpPlans relation VpPlans object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Models\VpPlansQuery A secondary query class using the current class as primary query
     */
    public function useVpPlansQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVpPlans($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VpPlans', '\App\Models\VpPlansQuery');
    }

    /**
     * Filter the query by a related \App\Models\VpExercises object
     *
     * @param \App\Models\VpExercises|ObjectCollection $vpExercises the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildVpDaysQuery The current query, for fluid interface
     */
    public function filterByVpExercises($vpExercises, $comparison = null)
    {
        if ($vpExercises instanceof \App\Models\VpExercises) {
            return $this
                ->addUsingAlias(VpDaysTableMap::COL_ID, $vpExercises->getDayId(), $comparison);
        } elseif ($vpExercises instanceof ObjectCollection) {
            return $this
                ->useVpExercisesQuery()
                ->filterByPrimaryKeys($vpExercises->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByVpExercises() only accepts arguments of type \App\Models\VpExercises or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VpExercises relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildVpDaysQuery The current query, for fluid interface
     */
    public function joinVpExercises($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VpExercises');

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
            $this->addJoinObject($join, 'VpExercises');
        }

        return $this;
    }

    /**
     * Use the VpExercises relation VpExercises object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Models\VpExercisesQuery A secondary query class using the current class as primary query
     */
    public function useVpExercisesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVpExercises($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VpExercises', '\App\Models\VpExercisesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildVpDays $vpDays Object to remove from the list of results
     *
     * @return $this|ChildVpDaysQuery The current query, for fluid interface
     */
    public function prune($vpDays = null)
    {
        if ($vpDays) {
            $this->addUsingAlias(VpDaysTableMap::COL_ID, $vpDays->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the vp_days table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VpDaysTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VpDaysTableMap::clearInstancePool();
            VpDaysTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(VpDaysTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VpDaysTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VpDaysTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VpDaysTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // VpDaysQuery
